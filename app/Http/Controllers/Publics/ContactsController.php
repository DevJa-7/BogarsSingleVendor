<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ContactsModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use Log;

class ContactsController extends Controller
{

    private $mail;

    public function index()
    {
        return view('publics.contacts', [
            'cartProducts' => $this->products,
            'head_title' => Lang::get('seo.title_contacts'),
            'head_description' => Lang::get('soe.descr_contacts')
        ]);
    }

    public function sendMessage(Request $request)
    {
        $post = $request->all();
        $this->loadSettings();
        $errors = array();
        if (!filter_var($post['client_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = Lang::get('public_pages.invalid_email');
        }
        if (mb_strlen(trim($post['client_message'])) == 0) {
            $errors[] = Lang::get('public_pages.too_short_message');
        }
        if (empty($errors)) {
            return $this->sendEmail($post);
        } else {
            return redirect(lang_url('contacts'))->with(['msg' => $errors, 'result' => false]);
        }
    }

    private function sendEmail($post)
    {
        $this->mail->setFrom($post['client_email'], $post['name']);
        $this->mail->addAddress(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //$this->mail->isHTML(true); 
        $this->mail->Subject = Lang::get('customer_pages.mail_contact_subject');
        $this->mail->Body = $post['client_message'];
        if (!$this->mail->send()) {
            Log::critical($this->mail->ErrorInfo);
            return redirect(lang_url('contacts'))->with(['msg' => Lang::get('public_pages.problem_message_send'), 'result' => false]);
        }
        return redirect(lang_url('contacts'))->with(['msg' => Lang::get('public_pages.message_sended'), 'result' => false]);
    }

    private function loadSettings()
    {
        $this->mail = new PHPMailer();
        // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;            // Enable verbose debug output 
        $this->mail->isSMTP();                                  // Set mailer to use SMTP
        $this->mail->Host = env('MAIL_HOST');                // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                           // Enable SMTP authentication
        $this->mail->Username = env('MAIL_FROM_ADDRESS');       // SMTP username
        $this->mail->Password = env('MAIL_PASSWORD');       // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                        // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = env('MAIL_PORT');               // TCP port to connect to
    }

    public function sendPaymentConfirmEmail($email, $name) {

        $this->loadSettings();

        $this->mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $this->mail->addAddress($email, $name);
        $this->mail->isHTML(true); 
        $this->mail->Subject = Lang::get('customer_pages.mail_contact_subject');
        $this->mail->Body = $this->buildEmailTemplate();
        if (!$this->mail->send()) {
            return false;
        }
        return true;
    }

    public function buildEmailTemplate()
    {
        $user = auth()->user();
        ob_start();
        include '../resources/views/publics/confirm_email.php';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
