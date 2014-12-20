<?php

    return array(
        /**
         * Model title
         *
         * @type string
         */
        'title' => 'Posts',

        /**
         * The singular name of your model
         *
         * @type string
         */
        'single' => 'Post',

        /**
         * The class name of the Eloquent model that this config represents
         *
         * @type string
         */
        'model' => 'Post',

        /**
         * The columns array
         *
         * @type array
         */
        'columns' => array(
            'id' => array(
                'title' => 'Id',
            ),
            'subject' => array(
                'title' => 'Subject',
            ),
            'body' => array(
                'title' => 'Body',
            ),
            'comment_count' => array(
                'title' => 'Comment_count',
            ),
            'user_id' => array(
                'title' => 'User_id',
            ),
            'cat_id' => array(
                'title' => 'Cat_id',
            )

        ),

        /**
         * The edit fields array
         *
         * @type array
         */
        'edit_fields' => array(
            'subject' => array(
                'title' => 'Subject',
                'type'  => 'text',
            ),
            'body' => array(
                'title' => 'Body',
                'type'  => 'text',
            ),

         ),
    );
