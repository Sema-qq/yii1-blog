<?php


namespace base;


abstract class BaseController
{
    private $view;
    private $data;

    public function view($view, $data = [], $mini = false)
    {
        $this->view = $view;
        $this->data = $data;

        if ($mini) {
            return $this->getViewMini();
        }

        return require DEFAULT_LAYOUT;
    }

    public function redirect($view)
    {
        return header("Location: {$view}");
    }

    private function getContent()
    {
        extract($this->data);

        $cn = strtolower(str_replace(['controllers\\', 'Controller', 'components\\'], '', get_class($this)));

        return require VIEW_PATH . $cn . '/' . $this->view . BASE_EXT;
    }

    private function getViewMini()
    {
        echo $this->getContent();
    }

    public function getContent2()
    {
        ob_start();

        $this->getContent();

        return ob_get_clean();
    }
}
