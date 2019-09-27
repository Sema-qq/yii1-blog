<?php


namespace controllers;


use base\BaseController;
use components\Request;
use components\Server;
use components\User;
use models\Contact;

class ContactController extends BaseController
{
    public function actionIndex()
    {
        $sort = Request::get('sort');

        $contacts = Contact::model()
            ->find()
            ->sort(['name' => $sort ? $sort : 'ASC'])
            ->where(['user_id' => User::currentUser()->id])
            ->all();

        return $this->view('index', [
            'contacts' => $contacts,
            'sort' => $sort && $sort == 'ASC' ? 'DESC' : 'ASC'
        ]);
    }

    public function actionCreate()
    {
        $contact = new Contact();
        $contact->user_id = User::currentUser()->id;

        if (Server::isPost()) {
            $contact->load(Request::post());

            if ($contact->save()) {
                return self::redirect('/contact/show/' . $contact->id);
            }
        }

        return $this->view('create', [
            'contact' => $contact
        ]);
    }

    public function actionEdit($id)
    {
        $contact = Contact::getContact($id);

        if (Server::isPost()) {
            $contact->load(Request::post());

            if ($contact->save()) {
                return self::redirect('/contact/show/' . $contact->id);
            }
        }

        return $this->view('edit', [
            'contact' => $contact
        ]);
    }

    public function actionShow($id)
    {
        $contact = Contact::getContact($id);

        return $this->view('show', [
            'contact' => $contact
        ]);
    }

    public function actionDelete($id)
    {
        if (Server::isPost()) {
            $contact = Contact::getContact($id);
            $contact->deleteById($id);
        }

        return self::redirect('/contact/index');
    }
}
