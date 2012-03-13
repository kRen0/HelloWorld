<?php defined('BASEPATH') or exit('No direct script access allowed');


class Module_Feedback extends Module {

    public $version = '1.0';

    public function info()
    {
        return array(
            'name' => array(
                'ru' => 'Обратная связь',
				'en' => 'Feedback'
            ),
            'description' => array(
                'en' => 'Модуль для осуществления обратной связи.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'Обратная связь', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
            'sections' => array(
                'feeds' => array(
                    'name'  => 'feedback.views', // These are translated from your language file
                    'uri'   => 'admin/feedback')
                )
        );
    }

    public function install()
    {
        $this->dbforge->drop_table('feedback');

        $feedback = array(
            'id' => array(
            'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
			'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
			'message' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ),
        );


        $this->dbforge->add_field($feedback);
        $this->dbforge->add_key('id', TRUE);

        // Let's try running our DB Forge Table and inserting some settings
        if ( ! $this->dbforge->create_table('feedback') )
        {
            return FALSE;
        }

        // No upload path for our module? If we can't make it then fail
        if ( ! is_dir($this->upload_path.'feedback') AND ! @mkdir($this->upload_path.'feedback',0777,TRUE))
        {
            return FALSE;
        }

        // We made it!
        return TRUE;
    }

    public function uninstall()
    {
        $this->dbforge->drop_table('feedback');

        // Put a check in to see if something failed, otherwise it worked
        return TRUE;
    }


    public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help()
    {
        // Return a string containing help info
        return "KISS <3";

        // You could include a file and return it here.
        return $this->load->view('help', NULL, TRUE); // loads modules/sample/views/help.php
    }
}
/* End of file details.php */