<?php

function university_posty_Types()
{
    register_post_type(
        "event",
        array(
            "supports" => array("title", "editor", "excerpt"),
            "rewrite" => array("slug" => "events"),
            "has_archive" => true,
            "public" => true,
            "show_in_rest" => true,
            "labels" => array(
                "name" => "Events",
                "add_new_item" => "Add New Event",
                "edit_item" => "Edit Item",
                "all_items" => "All Events",
                "singular_name" => "Event"
            ),
            "menu_icon" => "dashicons-calendar"

        )
    );

    // Program post type

    register_post_type(
        "program",
        array(
            "supports" => array("title", "editor"),
            "rewrite" => array("slug" => "programs"),
            "has_archive" => true,
            "public" => true,
            "show_in_rest" => true,
            "labels" => array(
                "name" => "Programs",
                "add_new_item" => "Add New Programs",
                "edit_item" => "Edit Item",
                "all_items" => "All Programss",
                "singular_name" => "Program"
            ),
            "menu_icon" => "dashicons-awards"

        )
    );

    // POROFESSORS post type

    register_post_type(
        "professor",
        array(
            "supports" => array("title", "editor", "thumbnail"),
            "public" => true,
            "show_in_rest" => true,
            "labels" => array(
                "name" => "Professors",
                "add_new_item" => "Add New Professors",
                "edit_item" => "Edit Item",
                "all_items" => "All Professorss",
                "singular_name" => "Professor"
            ),
            "menu_icon" => "dashicons-welcome-learn-more"

        )
    );
}

add_action("init", "university_posty_Types",);
