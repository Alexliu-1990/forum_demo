<?php

return array(

        /**
         * Model title
         *
         * @type string
         */
        'title' => 'Comments',

        /**
         * The singular name of your model
         *
         * @type string
         */
        'single' => 'Comment',

        /**
         * The class name of the Eloquent model that this config represents
         *
         * @type string
         */
        'model' => 'Comment',

        /**
         * The columns array
         *
         * @type array
         */
        'columns' => array(
            'id' => array(
                'title' => 'Id',
            ),
            'content' => array(
                'title' => 'Content',
            ),
            'user_id' => array(
                'title' => 'User_id',
            ),
            'post_id' => array(
                'title' => 'Post_id',
            )

        ),

        /**
         * The edit fields array
         *
         * @type array
         */
        'edit_fields' => array(
            'content' => array(
                'title' => 'Content',
                'type' => 'text'
            ),
         ),
 );
