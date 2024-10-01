<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Firebase;
use Kreait\Firebase\Database\Transaction;


class FirebaseController extends Controller
{

    private $db;
    public function __construct()
    {
        $this->db = Firebase::database();
    }

    public function index(Request $request) {

        /*$db->getReference('course')
            ->set([
                'name' => 'Laravel 9 Eğitimi Güncelleme',
                'email' =>  'huseyinerbayat@hotmail.com',
                'website' => 'https://www.udemy.com/course/php-laravel-egitimi',
                ]); */

        //$post = $db->getReference('posts/-NK8E8xPNaO3FfGZhWqf')->getSnapshot();
        //dd($post);
        $postData = ['name' => 'Lorem ipsum dolor sit amet. 3', 'price' => 1];
        $updated = $this->db->getReference('products/-NKaXZDY2K9rs_FYbjyb')->update($postData)->getSnapshot();

        dd($updated);

        //$ref = $this->db->getReference('products')->orderByChild('price')->limitToFirst(2)->startAt(4);
       // $snapshot = $ref->getSnapshot();
       // dd($snapshot);
            
        $postData = ['name' => 'Lorem ipsum dolor sit amet. 3', 'price' => 3];
        $postData2 = ['name' => 'Lorem ipsum dolor sit amet. 4', 'price' => 4];
        $postRef = $this->db->getReference('products')->push($postData);
        $postRef = $this->db->getReference('products')->push($postData2);
        //dd($postRef);$snapshot =
        $ref = $this->db->getReference('posts');
        $value = $ref->getValue();
        //dd($value);
        //return;
        $ref = $this->db->getReference('posts');
        $snapshot = $ref->getSnapshot();
        dd($snapshot);
        $value = $ref->getValue();
        dd($value["website"]["email"]);

        $this->db->getReference('posts/-NK8E8vsJQr2Fs77nNtl')->remove();
        return;
        $toBeDeleted = $this->db->getReference('posts');

        /*$db->runTransaction(function (Transaction $transaction) use ($toBeDeleted) {
            
            $sn = $transaction->snapshot($toBeDeleted);
            dd($sn);
            $transaction->remove($toBeDeleted);
        });*/

        return;
        $auth = Firebase::auth();
        $email = 'huseyin_erbayat@gmail.com';
        $clearTextPassword = '12345678';
        $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
        $idToken = $signInResult->idToken();
        
        $sessionCookieString = $auth->createSessionCookie($idToken, 300);

        $verifiedSessionCookie = $auth->verifySessionCookie($sessionCookieString);

        $uid = $verifiedSessionCookie->claims()->get('sub');

        $uid = 'v6QDlHQaklaaCBLHu7CGlUerpqf2';
        $auth->revokeRefreshTokens($uid);

        $user = $auth->getUser($uid);

        $signInResult = $auth->signInWithRefreshToken($signInResult->refreshToken());

        dd($auth->verifyIdToken($signInResult->accessToken()));
        dd($signInResult->accessToken());
        $userList = $auth->listUsers(100,100);

        foreach($userList as $user) {
            dd($user);
            return;
        }

        return;
        /*$uuid = Str::uuid();
        $d = $defaultAuth->createCustomToken($uuid)->toString();*/
        $email = 'huseyin_erbayat@gmail.com';
        $clearTextPassword = '12345678';
        $name = 'Hüseyin Erbayat';

        $userProperties = [
            'email' => $email,
            'emailVerified' => false,
           // 'phoneNumber' => '+15555550100',
            'password' => $clearTextPassword,
            'displayName' => $name,
            'photoUrl' => 'http://www.example.com/12345678/photo.png',
            //'disabled' => false,
        ];
        $createdUser = $auth->createUser($userProperties);

        dd($createdUser->uid);
    }
}
