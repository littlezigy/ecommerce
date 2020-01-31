<?php 
class View {
    private static $_instance = 0;
    private $skin = 'default';
    private $skin_file;
    private $skin_templates_dir;
    private $skin_parent = null;
    protected $user;
    private $templates_dir;
    protected $currency = '&#8358;';

    private function __construct(/*User $usermodel*/) {
        $this->skin_file = __DIR__ . "/../html/skins/default.tpl";
        $this->skin_templates_dir = __DIR__ . "/../html/templates/default/";
        $this->templates_dir = __DIR__ . "/../html/templates/";
    }

    public static function view() {
        if(self::$_instance === 0) {
            self::$_instance = new View();
        }

        return self::$_instance;
    }

    public function set_skin(String $skin) {
        $this->skin = $skin;
        $this->skin_templates_dir = __DIR__ . "/../html/templates/" . $this->skin . "/";
    }

    /**
     * Sets the $user variable. $user object is used in most skins.
     */
    public function set_user(User $usermodel) {
        $this->user = $usermodel->getUser();
    }
    
    /**
     * Page builder function.
     * @params $template - 
     */
    protected function build_page($page_contents, $page_vars = []) {
        //$js = $this->loadjs();
        $this->loadcss($this->skin);
        $copyright_date = date('Y');

        extract($page_vars);

        $user = $this->user;
        echo "<!--Page Builder-->\n";
        require $this->skin_file;
    }

    protected function loadPartial(String $partial, Array $var_array = []) {
        $this->skin_templates_dir .= 'partials/';
        $this->templates_dir .= 'partials/';

        $output = $this->loadTemplate($partial, $var_array);

        //Reset template paths;
        $this->skin_templates_dir = __DIR__ . "/../html/templates/default/";
        $this->templates_dir = __DIR__ . "/../html/templates/";

        return $output;
    }

    protected function loadTemplate(String $template, Array $variables_array = []) {
        //Checks for the template file in the skin's directory first.
        //Then check in the templates directory.
        $file = $this->skin_templates_dir . $template . ".tpl";
        echo "<!--Loading Template $template-->";
        
        //If file exists in the skin directory in templates, load that. Else load the file in the templates directory.
        if(file_exists($file)) {
            echo "<!-- Skin template found -->";
        } else {
            echo "<!-- Skin template not found. Loading default template file-->\n";
            $file = $this->templates_dir . $template . ".tpl";
            if(file_exists($file)) {
                echo "<!--Template file found -->";
            } else return "";
        }

        $contents = $this->loadcss("$this->skin.$template");

        extract($variables_array);

        ob_start();
        require_once $file;
        $contents .= ob_get_clean();
        return $contents;
    }

    public function build_form($form_elements, $form_template = null) {
        $input = __DIR__ . "/../templates/forms/inputtext.php";
        $textarea = __DIR__ . "/../templates/forms/textarea.php";
        $select = __DIR__ . "/../templates/forms/select.php";

        $type = "text";
        $placeholder = '"Enter Text Here"';
        $classList = null;

        ob_start();
        foreach($form_elements as $element=>$build_options) {
            foreach($build_options as $build_option => $value) {
                ${$build_option} = $value;
            }
            require ${$element};
        }
        $form_contents = ob_get_clean();

        return $form_contents;
    }

    public function editor_page($form_details, $form_elements, $template = null) {
        $form = __DIR__ . "/../templates/forms/form.php";

        $form_contents = $this->build_form($form_elements);

        $form_title = $form_details['title'];
        $form_description = $form_details['description'];
        $form_name = $form_details['name'];
        $form_submit_button = @$form_details['submit_button_text'] || "Submit";

        ob_start();
        require $form;
        $contents = ob_get_clean();

        $this->build_page($contents);
    }

    public function creator_page($form_details, $form_elements) {
        $form = __DIR__ . "/../templates/forms/form.php";

        $form_contents = $this->build_form($form_elements);
        $form_submit_button = (array_key_exists('submit_button_text', $form_details)) ? $form_details[submit_button_text] : "Submit";

        $form_arr = array("form_title" => $form_details['title'],
                        "form_description" => $form_details["description"],
                        "form_name" => $form_details['name'],
                        "form_submit_button" => $form_submit_button,
                        "form_contents" => $form_contents
                    );

        //ob_start();
        //require $form;
        $contents = $this->loadTemplate("form", $form_arr);
        //ob_get_clean();

        $this->build_page($contents);
    }

    public function header(User $usermodel) {
        $user = $usermodel->getUser();
        require_once  __DIR__ . "/includes/header.php";
    }

    /**
     * Loads the css files for the current skin. Skin css files are named skin.skin_name.css. 
     * So for skin default, the css file is ==> skin.default.css
     */
    private function loadcss(String $css_file = null) {
        $css_dir = __DIR__ . "/../styles";
        echo "<!--Load Css function for $css_file-->";

        if(is_file($css_dir . "/skin.$css_file.css")) {
            $css = "<link rel = 'stylesheet' href = '/styles/skin.". $css_file . ".css'>";
            echo $css;
        } else {
            echo "<!--Skin css file not found-->";
            return false;
        }
    }

    private function loadjs() {
        ob_start();
        require __DIR__ . "/includes/scripts.php";
        
        return ob_get_clean();
    }
}