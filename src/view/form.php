<?php
abstract class Form {
    public static function renderForm(string $title, array $elems, string $action, string $submitValue): string {
        $form = '<h1>' . $title . '</h1>';
        $form .= '<form method="POST" action=' . $action . '>';
        foreach ($elems as $elem) {
            $form .= '<div class="form-element">';
            if ($elem['type'] !== 'submit') {
                $form .= '<label for="' . $elem['name'] . '">' . $elem['label'] . '</label>';
                $form .= '<input type="' . $elem['type'] . '" name="' . $elem['name'] . '" placeholder="' . $elem['placeholder'] . '"' . $elem['required'] . '>';
            } else {
                $form .= '<input class="green-cta-btn green-cta-form-btn" type="' . $elem['type'] . '" name="' . $elem['name'] . '"' . "value=\"$submitValue\"" . $elem['required'] . '>';
            }
            $form .= '</div>';
        }
        $form .= '</form>';
        return $form;
    }

}