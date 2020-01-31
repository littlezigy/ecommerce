<?php 
Class Page extends View {
    private $view;

    public function __construct() {
        $this->view = parent::view();
    }

    /**
     * Function for viewing the homepage
     */
    public function home($productlist) {
        echo "<!--HOME-->";
        $bestproducts = $productlist->getProducts();
        var_dump($bestproducts);
        $no_navbar = true;
        echo "<!-- NAVBAR: $no_navbar-->";
        foreach($bestproducts as $products) {
            if($products['shortdesc_'] == '') {
                $products['shortdesc_'] = "This is a great product judging by the fact that it is in this category";
            }
        }
        $contents = $this->view->loadTemplate("home", array("user" => $this->user, "bestproducts" => $bestproducts));
        $this->view->build_page($contents, array("no_navbar" => true));
    }

    public function login() {
        echo "<script>window.location.replace('/')</script>";
        $contents = $this->view->loadTemplate('login');
        $this->view->build_page($contents);
    }

    public function user_dashboard($wrapped_contents) {
        echo "<!--U dashboaard funtion-->";
        $contents = $this->view->loadTemplate('user_dash_wrapper', array('user_page_content' => $wrapped_contents));
        echo "<!--Calling page builder from u dashboard-->";
        $this->view->build_page($contents);
    }

    public function user_orders() {
        $contents = '';
        $greeting = "Welcome {$this->user['firstname']}";
        $contents .= $this->view->loadTemplate('user_orders', (array(
            "greeting" => $greeting,
            "currency" => $this->currency
        )));
        $this->user_dashboard($contents);
    }

    /**
     * Function for viewing regular pages with no variables.
     */
    public function regular(String $template = 'notFound') {
        $contents = $this->view->loadTemplate($template);
        $this->view-> build_page($contents);
    }
}