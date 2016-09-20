<?php
return [
    'title' => array(
        'label' => 'Titre',
        'type' => 'text'
    ),
    'content' => array(
        'label' => 'Contenu',
        'type' => 'wysiwyg'
    ),
    'line_centered' => array(
        'label' => 'un input text classique',
        'type' => 'text'
    ),
    'line_centered2' => array(
        'label' => 'un input text classique',
        'type' => 'text_mal_ecrit_et_qui_du_coup_existe_pas'
    ),
    'textarea_test' => array (
        'label' => 'une textarea de gauche',
        'type' => 'textarea',
    ),
    'mdp' => array(
        'label' => 'Password',
        'type' => 'password'
    ),
    'wysiwyg_left' => array (
        'label' => 'wysiwyg de gauche',
        'type' => 'wysiwyg',
        'value' => array (
        )
    ),
    'taille' => array (
        'label' => 'taille de la police',
        'type' => 'select',
        'value' => array (
            'petit' => 'Petite police',
            'moyen' => 'Moyenne police',
            'grand' => 'Grande police',
        )
    ),
    'checkbox' => array (
        'label' => 'êtes vous con?',
        'type' => 'checkbox',
    ),
    'mail' => array (
        'label' => 'ton email',
        'type' => 'email'
    )
];