<?php
class Form {
    public static function renderForm(string $title, array $elems, string $action): string {
        $form = '<h1>' . $title . '</h1>';
        $form .= '<form method="POST" action=' . $action . '>';
        foreach ($elems as $elem) {
            $form .= '<input type="' . $elem['type'] . '" name="' . $elem['name'] . '" placeholder="' . $elem['placeholder'] . '">';
        }
        $form .= '</form>';
        return $form;
    }

}