<?php


namespace controllers;


use base\BaseController;
use components\File;
use components\Request;
use components\Server;
use components\Session;
use components\User;
use models\Contact;
use models\FileUploader;

class ContactController extends BaseController
{
    public function view($view, $data = [], $mini = false)
    {
        if (Server::isAjax()) {
            $mini = true;
        }

        return parent::view($view, $data, $mini);
    }

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
        $contact = Contact::getContact($id);

        if (!$contact->delete()) {
            if ($contact->hasErrors()) {
                Session::set(Contact::ERROR_SESSION_KEY, $contact->getErrors());
            }

            return self::redirect(Server::getReferer());
        }

        return self::redirect('/contact/index');
    }

    public function actionPhoto($id)
    {
        $contact = Contact::getContact($id);

        $uploader = new FileUploader(['png', 'jpg']);

        if (Server::isPost() && ($file = File::files('file'))) {
            $uploader->load($file);

            if ($filename = $uploader->upload()) {
                if ($contact->photoSave($filename)) {
                    return self::redirect('/contact/show/' . $contact->id);
                }
            }
        }

        return $this->view('photo', [
            'contact' => $contact,
            'uploader' => $uploader
        ]);
    }

    public function actionDeletePhoto($id)
    {
        $contact = Contact::getContact($id);

        if (!$contact->deleteCurrentPhoto() && $contact->hasErrors()) {
            Session::set(Contact::ERROR_SESSION_KEY, $contact->getErrors());
        }

        return self::redirect('/contact/show/' . $contact->id);
    }
}
