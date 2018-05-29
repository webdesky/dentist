<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    //public $components = array('Session','DebugKit.Toolbar','CustomFunction');
    public $components = array('Session','CustomFunction');
    public function authenticate()
    {
        // Check if the session variable User exists, redirect to loginform if not
        if( $this->action != 'login' )
        {
            if(!$this->Session->check('Member'))
            {
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                exit();
            }
        }
    }
    
    public function beforeFilter()
    {
        if(!empty($this->Session->read('Member'))){
            $member_sess = $this->Session->read('Member');
            $this->loadModel('MembersPayment');
            $this->loadModel('Plan');
            $payment_status = $this->MembersPayment->find('all',array('conditions'=>array('member_id'=>$member_sess['Member']['id']),'order'=>array('id'=>'desc'),'limit'=>1));
            // echo '<pre>'; 
            // echo $member_sess['Member']['id']; 
            // print_r($payment_status); 
            // die;
            if(!empty($payment_status[0])){
                $plan_status  = $this->Plan->find('all',array('conditions'=>array('id'=>$payment_status[0]['MembersPayment']['plan_id']),'order'=>array('id'=>'desc'),'limit'=>1));
                if(!empty($plan_status[0])){                    
                    $effectiveDate = date('Y-m-d', strtotime("+".$plan_status[0]['Plan']['duration']." months", strtotime($payment_status[0]['MembersPayment']['date'])));

                    if(strtotime($effectiveDate) > strtotime(date('Y-m-d'))){
                        $this->set('paid_status',1);
                    }else{
                         $this->set('paid_status',0);
                    }
                }
            }         

        }
       
       

        $this->loadModel('Configuration');
        $this->loadModel('Currency');
        $this->loadModel('Sitesetting');
        $custom=$this->Sitesetting->find('all');
        $this->set('custom',$custom);
        $sysSetting=$this->Configuration->find('first');
        $seoArr=$this->seoSetting($sysSetting['Configuration']);
        $this->set('metaTitle',$seoArr['metaTitle']);
        $this->set('metaKeyword',$seoArr['metaKeyword']);
        $this->set('metaContent',$seoArr['metaContent']);
        $currencyArr=$this->Currency->findById($sysSetting['Configuration']['currency']);
        $this->configLanguage=$sysSetting['Configuration']['language'];
        $this->siteTimezone=$sysSetting['Configuration']['timezone'];
        $this->siteOrganization=$sysSetting['Configuration']['organization_name'];
        Configure::write('Config.language', $this->configLanguage);
        Configure::write('Config.timezone', $this->siteTimezone);
        date_default_timezone_set($this->siteTimezone);
        $this->set('siteName',$sysSetting['Configuration']['name']);
        $this->set('siteOrganization',$this->siteOrganization);
        $this->set('siteAuthorName',$sysSetting['Configuration']['author']);
        $this->set('siteYear',$sysSetting['Configuration']['created']);
        $this->set('frontRegistration',$sysSetting['Configuration']['front_end']);
        $this->set('frontSlides',$sysSetting['Configuration']['slides']);
        $this->set('frontLogo',$sysSetting['Configuration']['photo']);
        $this->set('translate',$sysSetting['Configuration']['translate']);
        $this->set('frontPaidExam',$sysSetting['Configuration']['paid_exam']);
        $this->set('siteTimezone',$sysSetting['Configuration']['timezone']);
        $this->set('contact',explode("~",$sysSetting['Configuration']['contact']));
        $this->siteTimezone=$sysSetting['Configuration']['timezone'];
        $this->siteName=$sysSetting['Configuration']['name'];
        $this->siteDomain=$sysSetting['Configuration']['domain_name'];
        $this->siteEmail=$sysSetting['Configuration']['email'];
        $this->frontRegistration=$sysSetting['Configuration']['front_end'];
        $this->frontSlides=$sysSetting['Configuration']['slides'];
        $this->frontExamPaid=$sysSetting['Configuration']['paid_exam'];
        $currency='<img src="'.$this->webroot.'img/currencies/'.$currencyArr['Currency']['photo'].'"> ';
        $this->currency=$currency;
        $this->currencyType=$currencyArr['Currency']['short'];
        $this->set('currency',$currency);
        $this->set('currencyType',$this->currencyType);
        $this->emailNotification=$sysSetting['Configuration']['email_notification'];
        $this->smsNotification=$sysSetting['Configuration']['sms_notification'];
        $this->siteEmailContact=$sysSetting['Configuration']['email_contact'];
        $this->isChat=$sysSetting['Configuration']['chat'];
        $this->siteSignature=$sysSetting['Configuration']['signature'];
        $this->set('emailNotification',$this->emailNotification);
        $this->set('smsNotification',$this->smsNotification);
        $this->set('siteEmailContact',$this->siteEmailContact);
        $this->set('isChat',$this->isChat);
        $this->set('frontExamPaid',$this->frontExamPaid);
        $this->siteColor=$sysSetting['Configuration']['color'];
        $this->set('siteColor',$this->siteColor);
        $this->set('siteSignature',$this->siteSignature);
        $this->set('siteCertificate',$this->siteCertificate);
        $this->set('siteTestimonial',$sysSetting['Configuration']['testimonial']);
        $this->set('siteAds',$sysSetting['Configuration']['ads']);
        $this->set('sitePanel1',$sysSetting['Configuration']['panel1']);
        $this->set('sitePanel2',$sysSetting['Configuration']['panel2']);
        $this->set('sitePanel3',$sysSetting['Configuration']['panel3']);        
        $sysDateArr=explode(",",$sysSetting['Configuration']['date_format']);
        $this->sysDay=$sysDateArr[0];$this->sysMonth=$sysDateArr[1];$this->sysYear=$sysDateArr[2];
        $this->sysHour=$sysDateArr[3];$this->sysMin=$sysDateArr[4];$this->sysSec=$sysDateArr[5];$this->sysMer=$sysDateArr[6];
        $this->set('sysDay',$this->sysDay);$this->set('sysMonth',$this->sysMonth);$this->set('sysYear',$this->sysYear);
        $this->set('sysHour',$this->sysHour);$this->set('sysMin',$this->sysMin);$this->set('sysSec',$this->sysSec);$this->set('sysMer',$this->sysMer);
        $this->dateSep=$sysDateArr[7];$this->timeSep=$sysDateArr[8];$this->dateGap=" ";
        $this->set('dateSep',$this->dateSep);$this->set('timeSep',$this->timeSep);$this->set('dateGap',$this->dateGap);
        $dpDay=null;$dpMonth=null;$dpYear=null;$this->dtFormat=null;
        if(strtolower($this->sysDay)==strtolower("Y"))
        $dpDay=4;
        elseif(strtolower($this->sysDay)==strtolower("m"))
        $dpDay=2;
        elseif(strtolower($this->sysDay)==strtolower("d"))
        $dpDay=2;
        if(strtolower($this->sysMonth)==strtolower("Y"))
        $dpMonth=4;
        elseif(strtolower($this->sysMonth)==strtolower("m"))
        $dpMonth=2;
        elseif(strtolower($this->sysMonth)==strtolower("d"))
        $dpMonth=2;
        if(strtolower($this->sysYear)==strtolower("Y"))
        $dpYear=4;
        elseif(strtolower($this->sysYear)==strtolower("m"))
        $dpYear=2;
        elseif(strtolower($this->sysYear)==strtolower("d"))
        $dpYear=2;
        if($dpDay==null || $dpMonth==null || $dpYear==null)
        {
            $this->dpFormat="YYYY-MM-DD";
            $this->dtFormat="Y-m-d";
        }
        else
        {
            $this->dpFormat=strtoupper(str_repeat($this->sysDay,$dpDay).$this->dateSep.str_repeat($this->sysMonth,$dpMonth).$this->dateSep.str_repeat($this->sysYear,$dpYear));
            $this->dtFormat=$this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear;
        }
        $this->set('dpFormat', $this->dpFormat);
        $this->set('dtFormat', $this->dtFormat);
        $this->currentDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
        $this->userValue=$this->Session->read('Member');
        $this->adminValue=$this->Session->read('User');
        if($sysSetting['Configuration']['min_limit'])
        $minLimit=$sysSetting['Configuration']['min_limit'];
        else
        $minLimit=20;
        if($sysSetting['Configuration']['max_limit'])
        $maxLimit=$sysSetting['Configuration']['max_limit'];
        else
        $maxLimit=500;
        $this->pageLimit=$minLimit;
        $this->maxLimit=$maxLimit;
        if($sysSetting['Configuration']['captcha_type']==1)
        $this->captchaType="image";
        else
        $this->captchaType="math";
        if($sysSetting['Configuration']['dir_type']==1)
        $this->dirType="ltr";
        else
        $this->dirType="rtl";
        $this->set('dirType',$this->dirType);
        $this->set('captchaType',$this->captchaType);
        $this->set('configLanguage',$this->configLanguage);
        $this->set('userValue',$this->userValue);
        $this->set('adminValue',$this->adminValue);
        $this->loadModel('Content');
        $contents=array();$menuArr=array();
        $contents=$this->Content->find('all',array('fileds'=>array('link_name,is_url,url,page_url'),'conditions'=>array('published'=>'Published'),
                                            'order'=>'ordering asc'));
        $this->set('contents',$contents);
        $walletBalance="0.00";
        $menuArr=array(__("Dashboard")=>array("controller"=>"Dashboards","action"=>"","icon"=>"fa fa-home"),
                       __("Leader Board")=>array("controller"=>"Leaderboards","action"=>"index","icon"=>"fa fa-dashboard"),
                       __("My Exams")=>array("controller"=>"Exams","action"=>"index","icon"=>"fa fa-list-alt"),
                       __("My Result")=>array("controller"=>"Results","action"=>"index","icon"=>"fa fa-trophy"),
                       __("Group Performance")=>array("controller"=>"Groupperformances","action"=>"index","icon"=>"fa fa-cog"),
                       __("Payment")=>array("controller"=>"Payments","action"=>"index","icon"=>"fa fa-money"),
                       __("Transaction History")=>array("controller"=>"Transactionhistorys","action"=>"index","icon"=>"fa fa-briefcase"),
                       __("Mailbox")=>array("controller"=>"Mails","action"=>"index","icon"=>"fa fa-envelope"),
                       __("Help")=>array("controller"=>"Helps","action"=>"index","icon"=>"fa fa-support"));
        $frontmenuArr=array(__("Home")=>array("controller"=>"","action"=>"index","icon"=>"fa fa-home"),
                       __("Register")=>array("controller"=>"Registers","action"=>"index","icon"=>"fa fa-user"),
                       __("Log In")=>array("controller"=>"Users","action"=>"index","icon"=>"fa fa-lock"));
        $this->loadModel('Mail');
        if($this->userValue){
            $this->loadModel('Chat');
            $this->set('chatMemberArr',$this->Chat->find('all',array('conditions'=>array('OR'=>array(array('Chat.from_name'=>$this->userValue['Member']['user_name']),array('Chat.to_name'=>$this->userValue['Member']['user_name']))),
                                                                     'group'=>array('to_name'),
                                                                     'order'=>array('to_name'=>'asc'))));
            $emailCondition=$this->userValue['Member']['user_name'];
        }
        else
        $emailCondition='Administrator';
        $this->set('totalInbox',$this->Mail->find('count',array('conditions'=>array('email'=>$emailCondition,'status <>'=>'Trash','type'=>'Unread','mail_type'=>'To'))));
        $this->set('mailArr',$this->Mail->find('all',array('conditions'=>array('email'=>$emailCondition,'mail_type'=>'To','status <>'=>'Trash'),'order'=>array('Mail.id'=>'desc'),'limit'=>5)));
        $this->set('menuArr',$menuArr);
        $this->set('frontmenuArr',$frontmenuArr);
        $this->set('contentId','');
        $this->set('emailCondition',$emailCondition);
        $this->set('about',$this->Content->findByPageUrl('About-Us'));
        $this->emailSettings();
        $this->smsSettings();
    }
    /* Email Setting */
    public function emailSettings()
    {
        
            $this->loadModel('Emailsetting');
            $emailSettingArr=$this->Emailsetting->findById(1);
            $this->emailSettype=$emailSettingArr['Emailsetting']['type'];
            if($this->emailSettype=="Smtp")
            {
                $this->emailHost=$emailSettingArr['Emailsetting']['host'];
                $this->emailPort=$emailSettingArr['Emailsetting']['port'];
                $this->emailUsername=$emailSettingArr['Emailsetting']['username'];
                $this->emailPassword=$emailSettingArr['Emailsetting']['password'];
            }
        
    }
    /* End Email Settings */
    /* Email Setting */
    public function smsSettings()
    {
        if($this->smsNotification)
        {
            $this->loadModel('Smssetting');
            $smsSettingArr=$this->Smssetting->findById(1);
            $this->smsSettingArr=$smsSettingArr;
        }
    }
    /* End Email Settings */
    public function seoSetting($data)
    {
        $controller=strtolower($this->name);
        $action=strtolower($this->action);
        $metaTitle=null;$metaKeyword=null;$metaContent=null;
        $seoArr=array();
        $metaTableArr=array('contents','news');
        if($controller=="viewprofiles" && ($action=="profile" || $action=="view"))
        {
            $this->loadModel('Viewprofile');
            if($action=="profile"){
                $seoArr=$this->Viewprofile->find('first',array('conditions'=>array('Viewprofile.user_name'=>$this->request['pass'][0])));
            }
            if($action=="view"){
                $seoArr=$this->Viewprofile->find('first',array('conditions'=>array('Viewprofile.id'=>$this->request['pass'][0])));
            }
            if($seoArr)
            {
                $metaTitle=$seoArr['Viewprofile']['name'];
                $metaKeyword=null;
                $metaContent=$seoArr['Viewprofile']['about_me'];
            }
            else
            {
                throw new NotFoundException(__('Invalid post'));
            }
        }
        else
        {
            if(in_array($controller,$metaTableArr))
            {
                if(isset($this->request['pass'][0]))
                {
                    $this->loadModel($controller);
                    $seoArr=$this->$controller->find('first',array('conditions'=>array('page_url'=>$this->request['pass'][0])));
                }
                if($seoArr)
                {
                    $metaTitle=$seoArr[$controller]['meta_title'];
                    $metaKeyword=$seoArr[$controller]['meta_keyword'];
                    $metaContent=$seoArr[$controller]['meta_content'];
                }
            }
            else
            {
                $this->loadModel('Seo');
                $seoArr=$this->Seo->find('first',array('conditions'=>array('LOWER(controller)'=>$controller,'LOWER(action)'=>$action)));
                if($seoArr)
                {
                    $metaTitle=$seoArr['Seo']['meta_title'];
                    $metaKeyword=$seoArr['Seo']['meta_keyword'];
                    $metaContent=$seoArr['Seo']['meta_content'];
                }
            }
        }
        $seoSettingArr=array();
        if($seoArr)
        {
           if(strlen($metaTitle)>0)
           $seoSettingArr['metaTitle']=strip_tags($metaTitle);
           else
           $seoSettingArr['metaTitle']=strip_tags($data['meta_title']);
           if(strlen($metaKeyword)>0)
           $seoSettingArr['metaKeyword']=strip_tags($metaKeyword);
           else
           $seoSettingArr['metaKeyword']=strip_tags($data['meta_keyword']);
           if(strlen($metaContent)>0)
           $seoSettingArr['metaContent']=strip_tags($metaContent);
           else
           $seoSettingArr['metaContent']=strip_tags($data['meta_content']);
        }
        else
        {
            $seoSettingArr['metaTitle']=strip_tags($data['meta_title']);
            $seoSettingArr['metaKeyword']=strip_tags($data['meta_keyword']);
            $seoSettingArr['metaContent']=strip_tags($data['meta_content']);
        }
        return$seoSettingArr;
    }



    function get_transaction_history()
    {

        // From inside a controller
        echo $this->Auth->user('id');
    }
}
?>