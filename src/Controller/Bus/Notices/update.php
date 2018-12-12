<?php

use App\Form\UpdatePostForm;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Load detail
$data = null;
if (!empty($id)) {
    // Edit
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_notices_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        return $this->Flash->error(__('MESSAGE_DATA_NOT_EXIST'));
    }
    
    $pageTitle = __('LABEL_NOTICE_UPDATE');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}
$languageType = Configure::read('Config.languageType');

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/notices');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_NOTICE_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Create Update form 
$form = new UpdatePostForm();
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
        'id' => 'name',
        'label' => __('LABEL_TITLE'),
        'required' => true,
    ))
    ->addElement(array(
        'id' => 'content',
        'label' => __('LABEL_CONTENT'),
        'type' => 'editor'
    ))
    ->addElement(array(
        'id' => 'language_type',
        'label' => __('Ngôn ngữ'),
        'options' => $languageType
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
        // Call API
        $id = Api::call(Configure::read('API.url_notices_addupdate'), $data);
        if (!empty($id) && !Api::getError()) {            
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("{$this->BASE_URL}/{$this->controller}/update/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}