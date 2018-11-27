<?php

require APPPATH . '/libraries/REST_Controller.php';

class Faqs_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('faq_module/faqs_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function index_post() {
        $this->data = array();

        $questions = $this->faqs_model->faq_questions();

        $result = array();
        foreach ($questions as $question) :
            $answers = $this->faqs_model->faq_answers($question['id']);
            $answer_data = array();
            if ($answers):
                foreach ($answers as $answer) :
                    $answer_data[] = array(
                        'id' => $answer['id'],
                        'language_id' => $answer['language_id'],
                        'text' => $answer['text'],
                    );
                endforeach;
            endif;
            $result[] = array(
                'id' => $question['id'],
                'language_id' => $question['language_id'],
                'text' => $question['text'],
                'answers' => $answer_data,
            );
        endforeach;


        $this->data['data'] = $result;

        $this->response($this->data);
    }

}
