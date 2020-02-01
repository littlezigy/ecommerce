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
        $no_navbar = true;
        echo "<!-- NAVBAR: $no_navbar-->";

        $contents = $this->view->loadTemplate("home", array(
            "user" => $this->user, 
            "bestproducts" => $bestproducts,
            "currency" => $this->currency
        ));
        $this->view->build_page($contents, array("no_navbar" => true));
    }

    public function login() {
        echo "<script>window.location.replace('/')</script>";
        $contents = $this->view->loadTemplate('login');
        $this->view->build_page($contents);
    }

    public function products($productlistmodel, $category = 'all') {
        $productlist = $productlistmodel->getProducts();
        $contents = $this->view->loadTemplate('products_page', array(
            "products" => $productlist, 
            "currency" => $this->currency,
            "title" => "All Products"
        ));
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