<?php
use App\Lib\Api;
use Cake\Core\Configure;

$this->doGeneralAction();
$pageSize = Configure::read('Config.PageSize');

$languageType = Configure::read('Config.languageType');

// Create breadcrumb
$pageTitle = __('LABEL_CONTACT_LIST');
$this->Breadcrumb->setTitle($pageTitle)
        ->add(array(
            'name' => $pageTitle,
        ));

// Create search form
$dataSearch = array(
    'limit' => $pageSize
);
$this->SearchForm
        ->setAttribute('type', 'get')
        ->setData($dataSearch)
        ->addElement(array(
            'id' => 'title',
            'label' => __('Tiêu đề')
        ))
        ->addElement(array(
            'id' => 'language_type',
            'label' => __('Ngôn ngữ'),
            'options' => $languageType
        ))
        ->addElement(array(
            'id' => 'limit',
            'label' => __('LABEL_LIMIT'),
            'options' => Configure::read('Config.searchPageSize'),
        ))
        ->addElement(array(
            'type' => 'submit',
            'value' => __('LABEL_SEARCH'),
            'class' => 'btn btn-primary',
        ));

$param = $this->getParams(array(
    'limit' => $pageSize,
    'language_type' => 1
));

$result = Api::call(Configure::read('API.url_contacts_list'), $param);
$total = !empty($result['total']) ? $result['total'] : 0;
$data = !empty($result['data']) ? $result['data'] : array();

// Show data
$this->SimpleTable
        ->setDataset($data)
        ->addColumn(array(
            'id' => 'name',
            'title' => __('LABEL_NAME'),
            'empty' => ''
        ))
        ->addColumn(array(
            'id' => 'title',
            'title' => __('Tiêu đề'),
            'empty' => '-'
        ))
        ->addColumn(array(
            'id' => 'email',
            'title' => __('Email'),
            'empty' => '-'
        ))
        ->addColumn(array(
            'id' => 'phone',
            'title' => __('SĐT'),
            'empty' => '-'
        ))
        ->addColumn(array(
            'id' => 'message',
            'title' => __('Thông điệp'),
            'empty' => '-'
        ))
        ->addColumn(array(
            'id' => 'created',
            'type' => 'dateonly',
            'title' => __('LABEL_CREATED'),
            'width' => 100,
            'empty' => '',
        ));

$this->set('pageTitle', $pageTitle);
$this->set('total', $total);
$this->set('param', $param);
$this->set('limit', $param['limit']);
$this->set('data', $data);
