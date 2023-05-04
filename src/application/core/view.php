<?php

class View
{
    function generate($content_view, $template_view = null, $data = null, $title_page = null)
    {
        @$dataa['title'] = $title_page;
        include 'application/core/functions.php';
        include 'application/views/' . $template_view;
    }
}
