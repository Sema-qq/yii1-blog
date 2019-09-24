<?php


namespace base;

/**
 * Class BaseController
 */
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

    public function getContent()
    {
        ob_start();

        $this->getData();

        return ob_get_clean();
    }

    private function getData()
    {
        extract($this->data);

        $cn = strtolower(str_replace(['controllers\\', 'Controller', 'components\\'], '', get_class($this)));

        return require VIEW_PATH . $cn . '/' . $this->view . BASE_EXT;
    }

    private function getViewMini()
    {
        echo $this->getContent();
    }
}
