<?php

    return array(
        /**
         * Model title
         *
         * @type string
         */
        'title' => 'Users',

        /**
         * The singular name of your model
         *
         * @type string
         */
        'single' => 'User',

        /**
         * The class name of the Eloquent model that this config represents
         *
         * @type string
         */
        'model' => 'User',

        /**
         * The columns array
         *
         * @type array
         */
        'columns' => array(
            'id' => array(
                'title' => 'Id',
            ),
            'nickname' => array(
                'title' => 'Nickname',
            ),
            'active' => array(
                'title' => 'Active',
            ),
            'code' => array(
                'title' => 'Code',
            ),
             'comment_count' => array(
                'title' => 'Comment_count',
            ),
             'post_count' => array(
                'title' => 'Post_count',
            ),
             'gender' => array(
                'title' => 'Gender',
            ),
             'first_name' => array(
                'title' => 'first_name',
            ),
             'last_name' => array(
                'title' => 'last_name',
            ),


        ),

        /**
         * The edit fields array
         *
         * @type array
         */
        'edit_fields' => array(
            'active' => array(
                'title' => 'Active',
                'type'  => 'number',
            ),
         ),
    );

