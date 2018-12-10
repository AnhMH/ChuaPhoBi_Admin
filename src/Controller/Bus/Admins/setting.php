<?php

use App\Form\UpdateCommonForm;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Create breadcrumb
$pageTitle = __('LABEL_WEB_SETTING');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'name' => $pageTitle,
    ));

$param = array(
    'language_type' => $languageType
);
$languageTypes = Configure::read('Config.languageType');

$data = Api::call(Configure::read('API.url_settings_detail'), $param);
$data['language_type'] = $languageType;

// Create Update form 
$form = new UpdateCommonForm();
$this->UpdateForm->reset()
    ->setModel($form)
    ->setData($data)
    ->setAttribute('autocomplete', 'off')
    ->addElement(array(
        'id' => 'id',
        'type' => 'hidden',
        'label' => __('id'),
    ))
    ->addElement(array(
        'id' => 'language_type',
        'label' => __('LABEL_LANGUAGE_TYPE'),
        'options' => $languageTypes
    ))
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_WEB_NAME'),
    ))
    ->addElement(array(
        'id' => 'address',
        'label' => __('LABEL_ADDRESS'),
    ))
    ->addElement(array(
        'id' => 'email',
        'label' => __('LABEL_EMAIL'),
    ))
    ->addElement(array(
        'id' => 'phone',
        'label' => __('LABEL_TEL'),
    ))
    ->addElement(array(
        'id' => 'logo',
        'label' => __('LABEL_LOGO'),
        'image' => true,
        'type' => 'file'
    ))
    ->addElement(array(
        'id' => 'facebook',
        'label' => __('LABEL_FACEBOOK'),
    ))
    ->addElement(array(
        'id' => 'twitter',
        'label' => __('LABEL_TWITTER'),
    ))
//    ->addElement(array(
//        'id' => 'instagram',
//        'label' => __('LABEL_INSTAGRAM'),
//    ))
    ->addElement(array(
        'id' => 'google_plus',
        'label' => __('LABEL_GOOGLE_PLUS'),
    ))
    ->addElement(array(
        'id' => 'youtube',
        'label' => __('Youtube'),
    ))
    ->addElement(array(
        'id' => 'welcome_text',
        'label' => __('LABEL_WELCOME_TEXT'),
    ))
    ->addElement(array(
        'id' => 'footer_text',
        'label' => __('LABEL_FOOTER_TEXT'),
        'type' => 'editor'
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_SAVE'),
        'class' => 'btn btn-primary',
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_CANCEL'),
        'class' => 'btn',
        'onclick' => "return back();"
    ));

// Valdate and update
if ($this->request->is('post')) {
    // Trim data
    $data = $this->request->data();
    foreach ($data as $key => $value) {
        if (is_scalar($value)) {
            $data[$key] = trim($value);
        }
    }
    // Validation
    if ($form->validate($data)) {
        if (!empty($data['logo']['name'])) {
            $filetype = $data['logo']['type'];
            $filename = $data['logo']['name'];
            $filedata = $data['logo']['tmp_name'];
            $data['logo'] = new CurlFile($filedata, $filetype, $filename);
        }
        // Call API to Login
        $admin = array();
        $admin = Api::call(Configure::read('API.url_settings_addupdate'), $data);
        if (!empty($admin) && !Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("{$this->BASE_URL}/{$this->controller}/setting/".$languageType);
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}