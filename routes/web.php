<?php

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ExamCategoryController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OpinionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExamOpinionController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\TheoryPackageController;
use App\Http\Controllers\Admin\TheorySubscriptionController;
use App\Http\Controllers\Admin\YoutubeVideosControllerController;
use App\Mail\RegisterEmail;
use App\Mail\SubscriptionEmail;
use App\Models\Setting;
use App\Models\TheorySubscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    $setting = Setting::find(1);
    $data['first_phone'] = $setting->main_phone;
    $data['secound_phone'] = $setting->secoundry_phone;
    $data['email'] = $setting->email;
    $data['address_ar'] = $setting->address_ar;
    $data['address_nl'] = $setting->address_nl;
    $data['lang'] = 'ar';
    $data['user']=['name'=>'test'];


    $sub = TheorySubscription::orderBy('created_at', 'desc')->first();
    $data['packageName'] = $sub->package->{'name_' .  $data['lang']};
    $data['subscribtion'] = $sub;
        Mail::to($sub->email)->send(new SubscriptionEmail($data));
        Mail::to('mohameddeveloper0@gmail.com')->send(new SubscriptionEmail($data));
    if (Mail::failures()) {
        dd('hhh');
    }else{
        dd('send');
    }

});
Route::post('/language', [App\Http\Controllers\HomeController::class, 'changeLanguage'])->name('language.change');
Route::get('/importNewUsers', [App\Http\Controllers\Admin\BlogController::class, 'importNewUsers'])->name('importNewUsers');

Route::get('admin/login', function () {
    return view('admin.login');
})->name('adminLogin');
Auth::routes();

//admin auth routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'dashboard'])->name('dashboard');

    Route::controller(RoleController::class)->group(function () {
        Route::get('role', 'index')->middleware('can:role_list')->name('role.index');
        Route::post('role', 'store')->middleware('can:role_create')->name('role.store');
        Route::get('role/create', 'create')->middleware('can:role_create')->name('role.create');
        Route::get('role/{role}', 'show')->middleware('can:role_list')->name('role.show');
        Route::put('role/{role}', 'update')->middleware('can:role_update')->name('role.update');
        Route::delete('role/{role}', 'destroy')->middleware('can:role_delete')->name('role.destroy');
        Route::get('role/{role}/edit', 'edit')->middleware('can:role_update')->name('role.edit');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('setting', 'index')->name('setting.index');
        Route::post('setting', 'store')->name('setting.store');
        Route::put('setting/{setting}', 'update')->name('setting.update');
    });
    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->middleware('can:moderator_list')->name('user.index');
        Route::post('user', 'store')->middleware('can:moderator_create')->name('user.store');
        Route::get('user/create', 'create')->middleware('can:moderator_create')->name('user.create');
        Route::get('user/{user}', 'show')->middleware('can:moderator_list')->name('user.show');
        Route::put('user/{user}', 'update')->middleware('can:moderator_update')->name('user.update');
        Route::delete('user/{user}', 'destroy')->middleware('can:moderator_delete')->name('user.destroy');
        Route::get('user/{user}/edit', 'edit')->middleware('can:moderator_update')->name('user.edit');
    });

    //Opinions
    Route::controller(OpinionController::class)->group(function () {
        Route::get('opinion', 'index')->middleware('can:opinion_list')->name('opinion.index');
        Route::post('opinion', 'store')->middleware('can:opinion_create')->name('opinion.store');
        Route::get('opinion/create', 'create')->middleware('can:opinion_create')->name('opinion.create');
        Route::get('opinion/{opinion}', 'show')->middleware('can:opinion_list')->name('opinion.show');
        Route::put('opinion/{opinion}', 'update')->middleware('can:opinion_update')->name('opinion.update');
        Route::delete('opinion/{opinion}', 'destroy')->middleware('can:opinion_delete')->name('opinion.destroy');
        Route::get('opinion/{opinion}/edit', 'edit')->middleware('can:opinion_update')->name('opinion.edit');
        Route::post('opinion/updateEnabel', 'updateEnabel')->middleware('can:opinion_update')->name('opinion.updateEnabel');
    });

    //Pages
    Route::controller(PageController::class)->group(function () {
        Route::get('page', 'index')->middleware('can:page_list')->name('page.index');
        Route::post('page', 'store')->middleware('can:page_store')->name('page.store');
        Route::get('page/create', 'create')->middleware('can:page_store')->name('page.create');
        Route::get('page/{page}', 'show')->middleware('can:page_view')->name('page.show');
        Route::put('page/{page}', 'update')->middleware('can:page_edit')->name('page.update');
        Route::delete('page/{page}', 'destroy')->middleware('can:page_delete')->name('page.destroy');
        Route::get('page/{page}/edit', 'edit')->middleware('can:page_edit')->name('page.edit');
        Route::post('page/updateEnabel', 'updateEnabel')->middleware('can:page_update_enable')->name('page.updateEnabel');
    });

    //Youtube vedios
    Route::controller(YoutubeVideosControllerController::class)->group(function () {
        Route::get('youtub-videos', 'index')->name('youtubVideos.index');
        Route::post('youtub-videos', 'store')->name('youtubVideos.store');
        Route::get('youtub-videos/create', 'create')->name('youtubVideos.create');
        Route::get('youtub-videos/{youtubeVideosController}', 'show')->name('youtubVideos.show');
        Route::put('youtub-videos/{youtubeVideosController}', 'update')->name('youtubVideos.update');
        Route::delete('youtub-videos/{youtubeVideosController}', 'destroy')->name('youtubVideos.destroy');
        Route::get('youtub-videos/{youtubeVideosController}/edit', 'edit')->name('youtubVideos.edit');
        Route::post('youtub-videos/updateEnabel', 'updateEnabel')->name('youtubVideos.updateEnabel');
    });


    //Faq
    Route::controller(FaqController::class)->group(function () {
        Route::get('faq', 'index')->middleware('can:faq_list')->name('faq.index');
        Route::post('faq', 'store')->middleware('can:faq_store')->name('faq.store');
        Route::get('faq/create', 'create')->middleware('can:faq_store')->name('faq.create');
        Route::get('faq/{faq}', 'show')->middleware('can:faq_view')->name('faq.show');
        Route::put('faq/{faq}', 'update')->middleware('can:faq_edit')->name('faq.update');
        Route::delete('faq/{faq}', 'destroy')->middleware('can:faq_delete')->name('faq.destroy');
        Route::get('faq/{faq}/edit', 'edit')->middleware('can:faq_edit')->name('faq.edit');
        Route::post('faq/updateEnabel', 'updateEnabel')->middleware('can:faq_update_enable')->name('faq.updateEnabel');
        Route::post('faq/updateArrangment', 'updateArrangment')->middleware('can:faq_update_Arrangment')->name('faq.updateArrangment');
    });

    //BlogCategory
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('blogCategory', 'index')->middleware('can:blog_category_list')->name('blogCategory.index');
        Route::post('blogCategory', 'store')->middleware('can:blog_category_store')->name('blogCategory.store');
        Route::get('blogCategory/create', 'create')->middleware('can:blog_category_store')->name('blogCategory.create');
        Route::get('blogCategory/{blogCategory}', 'show')->middleware('can:blog_category_view')->name('blogCategory.show');
        Route::put('blogCategory/{blogCategory}', 'update')->middleware('can:blog_category_edit')->name('blogCategory.update');
        Route::delete('blogCategory/{blogCategory}', 'destroy')->middleware('can:blog_category_delete')->name('blogCategory.destroy');
        Route::get('blogCategory/{blogCategory}/edit', 'edit')->middleware('can:blog_category_edit')->name('blogCategory.edit');
    });

    //Blog
    Route::controller(BlogController::class)->group(function () {
        Route::get('blog', 'index')->middleware('can:blog_list')->name('blog.index');
        Route::post('blog', 'store')->middleware('can:blog_store')->name('blog.store');
        Route::get('blog/create', 'create')->middleware('can:blog_store')->name('blog.create');
        Route::get('blog/{blog}', 'show')->middleware('can:blog_view')->name('blog.show');
        Route::put('blog/{blog}', 'update')->middleware('can:blog_edit')->name('blog.update');
        Route::delete('blog/{blog}', 'destroy')->middleware('can:blog_delete')->name('blog.destroy');
        Route::get('blog/{blog}/edit', 'edit')->middleware('can:blog_edit')->name('blog.edit');
    });

    //Package
    Route::controller(PackageController::class)->group(function () {
        Route::get('package', 'index')->middleware('can:package_list')->name('package.index');
        Route::post('package', 'store')->middleware('can:package_store')->name('package.store');
        Route::get('package/create', 'create')->middleware('can:package_store')->name('package.create');
        Route::get('package/{package}', 'show')->middleware('can:package_view')->name('package.show');
        Route::put('package/{package}', 'update')->middleware('can:package_edit')->name('package.update');
        Route::delete('package/{package}', 'destroy')->middleware('can:package_delete')->name('package.destroy');
        Route::get('package/{package}/edit', 'edit')->middleware('can:package_edit')->name('package.edit');
        Route::post('package/cerateEditOffer', 'cerateEditOffer')->middleware('can:package_cerate_edit_offer')->name('package.cerateEditOffer');
        Route::post('package/getPackageOffers', 'getPackageOffers')->middleware('can:package_cerate_edit_offer')->name('package.getPackageOffers');
        Route::get('package/del/offer/{id}', 'delOffer')->middleware('can:package_cerate_edit_offer')->name('package.delOffer');
        Route::post('package/getPackagePrice', 'getPackagePrice')->name('package.getPackagePrice');
        Route::post('package/change', 'changeActive')->name('package.changeActive');
    });

    //Theory Package
    Route::controller(TheoryPackageController::class)->group(function () {
        Route::get('theoryPackage', 'index')->name('theoryPackage.index');
        Route::post('theoryPackage', 'store')->name('theoryPackage.store');
        Route::get('theoryPackage/create', 'create')->name('theoryPackage.create');
        Route::get('theoryPackage/{theoryPackage}', 'show')->name('theoryPackage.show');
        Route::put('theoryPackage/{theoryPackage}', 'update')->name('theoryPackage.update');
        Route::delete('theoryPackage/{theoryPackage}', 'destroy')->name('theoryPackage.destroy');
        Route::get('theoryPackage/{theoryPackage}/edit', 'edit')->name('theoryPackage.edit');
        Route::get('theoryPackage/exportPackageSubscribtions/{id}', 'exportPackageSubscribtions')->name('theoryPackage.exportPackageSubscribtions');
        Route::post('theoryPackage/updateEnabel', 'updateEnabel')->name('theoryPackage.updateEnabel');
        Route::post('theoryPackage/updateShowHome', 'updateShowHome')->name('theoryPackage.updateShowHome');

    });

    //Theory Subscription
    Route::controller(TheorySubscriptionController::class)->group(function () {
        Route::get('theorySubscription', 'index')->name('theorySubscription.index');
        Route::post('theorySubscription', 'store')->name('theorySubscription.store');
        Route::get('theorySubscription/create', 'create')->name('theorySubscription.create');
        Route::get('theorySubscription/{theorySubscription}', 'show')->name('theorySubscription.show');
        Route::put('theorySubscription/{theorySubscription}', 'update')->name('theorySubscription.update');
        Route::delete('theorySubscription/{theorySubscription}', 'destroy')->name('theorySubscription.destroy');
        Route::get('theorySubscription/{theorySubscription}/edit', 'edit')->name('theorySubscription.edit');
    });

    //Exam
    Route::controller(ExamController::class)->group(function () {
        Route::get('exam', 'index')->middleware('can:exam_list')->name('exam.index');
        Route::get('exam/getall/{id}', 'getExams')->middleware('can:exam_list')->name('exam.getExams');
        Route::post('exam', 'store')->middleware('can:exam_store')->name('exam.store');
        Route::get('exam/create', 'create')->middleware('can:exam_store')->name('exam.create');
        Route::get('exam/{exam}', 'show')->middleware('can:exam_view')->name('exam.show');
        Route::put('exam/{exam}', 'update')->middleware('can:exam_edit')->name('exam.update');
        Route::delete('exam/{exam}', 'destroy')->middleware('can:exam_delete')->name('exam.destroy');
        Route::get('exam/{exam}/edit', 'edit')->middleware('can:exam_edit')->name('exam.edit');
        Route::post('exam/updateAutoMove', 'updateAutoMove')->middleware('can:exam_update_auto_move')->name('exam.updateAutoMove');
        Route::post('exam/updateArrangment', 'updateArrangment')->middleware('can:exam_edit')->name('exam.updateArrangment');
        Route::post('exam/updateEnabel', 'updateEnabel')->name('exam.updateEnabel');
    });

    //ExamCategory
    Route::controller(ExamCategoryController::class)->group(function () {
        Route::get('examCategory', 'index')->middleware('can:exam_category_list')->name('examCategory.index');
        Route::get('examCategory/getby/{id}', 'getByExam')->middleware('can:exam_category_list')->name('examCategory.getByExam');
        Route::post('examCategory', 'store')->middleware('can:exam_category_store')->name('examCategory.store');
        Route::get('examCategory/create', 'create')->middleware('can:exam_category_store')->name('examCategory.create');
        Route::get('examCategory/{examCategory}', 'show')->middleware('can:exam_category_view')->name('examCategory.show');
        Route::put('examCategory/{examCategory}', 'update')->middleware('can:exam_category_edit')->name('examCategory.update');
        Route::delete('examCategory/{examCategory}', 'destroy')->middleware('can:exam_category_delete')->name('examCategory.destroy');
        Route::get('examCategory/{examCategory}/edit', 'edit')->middleware('can:exam_category_edit')->name('examCategory.edit');
        Route::post('examCategory/updateCategoryArrangmentExam', 'updateCategoryArrangmentExam')->name('examCategory.updateCategoryArrangmentExam');
        Route::post('examCategory/updateArrangment', 'updateArrangment')->middleware('can:exam_category_update_Arrangment')->name('examCategory.updateArrangment');
        Route::post('examCategory/getCategories', 'getCategories')->name('examCategory.getCategories');
        Route::post('examCategory/deleteExamCategory', 'deleteExamCategory')->name('examCategory.deleteExamCategory');
    });

    //Offers
    Route::controller(OfferController::class)->group(function () {
        Route::get('offer', 'index')->middleware('can:offer_list')->name('offer.index');
        Route::post('offer', 'store')->name('offer.store');
        Route::get('offer/create', 'create')->name('offer.create');
        Route::get('offer/{offer}', 'show')->middleware('can:offer_show')->name('offer.show');
        Route::put('offer/{offer}', 'update')->name('offer.update');
        Route::delete('offer/{offer}', 'destroy')->middleware('can:offer_delete')->name('offer.destroy');
        Route::get('offer/{offer}/edit', 'edit')->name('offer.edit');
        Route::post('offer/getOfferDiscount', 'getOfferDiscount')->name('offer.getOfferDiscount');
    });

    //Questions
    Route::controller(QuestionController::class)->group(function () {
        Route::get('question', 'index')->middleware('can:question_list')->name('question.index');
        Route::post('question/copy', 'copy')->middleware('can:question_create')->name('question.copy');
        Route::post('question', 'store')->middleware('can:question_create')->name('question.store');
        Route::get('question/create', 'create')->middleware('can:question_create')->name('question.create');
        Route::get('question/{question}', 'show')->middleware('can:question_show')->name('question.show');
        Route::put('question/{question}', 'update')->middleware('can:question_update')->name('question.update');
        Route::delete('question/{question}', 'destroy')->middleware('can:question_delete')->name('question.destroy');
        Route::get('question/{question}/edit', 'edit')->middleware('can:question_update')->name('question.edit');
        Route::post('question/updateQuestionArrangmentExam', 'updateQuestionArrangmentExam')->middleware('can:question_update')->name('question.updateQuestionArrangmentExam');
        Route::post('question/updateArrangment', 'updateArrangment')->middleware('can:question_update')->name('question.updateArrangment');
        Route::post('question/getQuestions', 'getQuestions')->middleware('can:question_list')->name('question.getQuestions');
        Route::post('question/deleteExamQuestion', 'deleteExamQuestion')->middleware('can:question_update')->name('question.deleteExamQuestion');
    });

    //Answers
    Route::controller(AnswerController::class)->group(function () {
        Route::get('answer', 'index')->middleware('can:answer_list')->name('answer.index');
        Route::post('answer', 'store')->middleware('can:answer_create')->name('answer.store');
        Route::get('answer/create', 'create')->middleware('can:answer_create')->name('answer.create');
        Route::get('answer/{answer}', 'show')->middleware('can:answer_view')->name('answer.show');
        Route::put('answer/{answer}', 'update')->middleware('can:answer_update')->name('answer.update');
        Route::delete('answer/{answer}', 'destroy')->middleware('can:answer_delete')->name('answer.destroy');
        Route::get('answer/{answer}/edit', 'edit')->middleware('can:answer_update')->name('answer.edit');
        Route::post('answer/updateArrangmentExam', 'updateArrangmentExam')->middleware('can:answer_update')->name('answer.updateArrangmentExam');
        Route::post('answer/updateRightAnswer', 'updateRightAnswer')->middleware('can:answer_update')->name('answer.updateRightAnswer');
        Route::post('answer/updateArrangment', 'updateArrangment')->middleware('can:answer_update')->name('answer.updateArrangment');
        Route::post('answer/deleteExamAnswer', 'deleteExamAnswer')->middleware('can:answer_update')->name('answer.deleteExamAnswer');
    });

    //Clients
    Route::controller(ClientController::class)->group(function () {
        Route::get('client', 'index')->middleware('can:client_list')->name('client.index');
        Route::post('client', 'store')->middleware('can:client_create')->name('client.store');
        Route::get('client/create', 'create')->middleware('can:client_create')->name('client.create');
        Route::get('client/{client}', 'show')->middleware('can:client_view')->name('client.show');
        Route::put('client/{client}', 'update')->middleware('can:client_update')->name('client.update');
        Route::delete('client/{client}', 'destroy')->middleware('can:client_delete')->name('client.destroy');
        Route::get('client/{client}/edit', 'edit')->middleware('can:client_update')->name('client.edit');

    });

    //Exam problems
    Route::controller(ExamOpinionController::class)->group(function () {
        Route::get('examOpinion', 'index')->name('examOpinion.index');
        Route::post('examOpinion', 'store')->name('examOpinion.store');
        Route::get('examOpinion/create', 'create')->name('examOpinion.create');
        Route::get('examOpinion/{examOpinion}', 'show')->name('examOpinion.show');
        Route::put('examOpinion/{examOpinion}', 'update')->name('examOpinion.update');
        Route::delete('examOpinion/{examOpinion}', 'destroy')->name('examOpinion.destroy');
        Route::get('examOpinion/{examOpinion}/edit', 'edit')->name('examOpinion.edit');
    });

    //BlogComment
    Route::controller(BlogCommentController::class)->group(function () {
        Route::get('blogComment', 'index')->name('blogComment.index');
        Route::post('blogComment', 'store')->name('blogComment.store');
        Route::get('blogComment/create', 'create')->name('blogComment.create');
        Route::get('blogComment/{blogComment}', 'show')->name('blogComment.show');
        Route::put('blogComment/{blogComment}', 'update')->name('blogComment.update');
        Route::delete('blogComment/{blogComment}', 'destroy')->name('blogComment.destroy');
        Route::get('blogComment/{blogComment}/edit', 'edit')->name('blogComment.edit');
    });

    //Subscriptions
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('subscription', 'index')->name('subscription.index');
        Route::post('subscription', 'store')->name('subscription.store');
        Route::get('subscription/create', 'create')->name('subscription.create');
        Route::get('subscription/{subscription}', 'show')->name('subscription.show');
        Route::put('subscription/{subscription}', 'update')->name('subscription.update');
        Route::delete('subscription/{subscription}', 'destroy')->name('subscription.destroy');
        Route::get('subscription/{subscription}/edit', 'edit')->name('subscription.edit');
    });
});

//site auth routes
Route::post('/purchase-theory-package', [App\Http\Controllers\Site\ClientController::class, 'purchaseTheoryPackage'])->name('purchaseTheoryPackage');
Route::get('/purchase-theory-done/{user_id}/{package_id}/{subid}', [App\Http\Controllers\Site\ClientController::class, 'purchaseTheoryDone'])->name('purchaseTheoryDone');
Route::get('/start_package', [App\Http\Controllers\Site\ClientController::class,'choseStart'])->name('start_package');
Route::get('/payment-afterlogin', [App\Http\Controllers\Site\ClientController::class,'paymentAfterlogin'])->name('payment-afterlogin');
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [App\Http\Controllers\Site\ClientController::class, 'index'])->name('account');
    Route::post('/purchase-package', [App\Http\Controllers\Site\ClientController::class, 'purchasePackage'])->name('purchasePackage');
    Route::get('/purchase-done/{user_id}', [App\Http\Controllers\Site\ClientController::class, 'purchaseDone'])->name('purchaseDone');
    Route::post('/change-password', [App\Http\Controllers\Site\ClientController::class, 'changePassword'])->name('password.change');
    Route::post('/exam-setting', [App\Http\Controllers\Site\ClientController::class, 'examSetting'])->name('examSetting');
});



//site none auth routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/exam-info/{exam_id}', [App\Http\Controllers\Site\ExamController::class, 'examInfo'])->name('examInfo');
Route::get('/exams', [App\Http\Controllers\HomeController::class, 'exams'])->name('exams');
Route::get('/blog/{slug}', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/article/{slug}', [App\Http\Controllers\HomeController::class, 'article'])->name('article');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contactUs');
Route::get('/packages', [App\Http\Controllers\HomeController::class, 'packages'])->name('packages');
Route::get('/theory-packages', [App\Http\Controllers\HomeController::class, 'theoryPackages'])->name('theoryPackages');
Route::get('/youtube-videos', [App\Http\Controllers\HomeController::class, 'getYoutubeVideos'])->name('getYoutubeVideos');
Route::post('/youtube-videos-tiktok-model', [App\Http\Controllers\HomeController::class, 'getModelData'])->name('tiktok.getModelData');
Route::post('/youtube-videos-instgram-model', [App\Http\Controllers\HomeController::class, 'getInstagramModelData'])->name('instagram.getInstagramModelData');


//in exam routes
Route::get('/start-exam/{exam_id}', [App\Http\Controllers\Site\ExamController::class, 'startExam'])->name('startExam');
Route::post('/exam-getInfo', [App\Http\Controllers\Site\ExamController::class, 'getInfo'])->name('exam.getInfo');
Route::post('/exam-getExamHistory', [App\Http\Controllers\Site\ExamController::class, 'getExamHistory'])->name('exam.getExamHistory');
Route::post('/examGetNextQuestion', [App\Http\Controllers\Site\ExamController::class, 'examGetNextQuestion'])->name('examGetNextQuestion');
Route::post('/examGetPrevQuestion', [App\Http\Controllers\Site\ExamController::class, 'examGetPrevQuestion'])->name('examGetPrevQuestion');
Route::post('/answerMcqQuestion', [App\Http\Controllers\Site\ExamController::class, 'answerMcqQuestion'])->name('inExam.answerMcqQuestion');
Route::post('/answerMcqImageQuestion', [App\Http\Controllers\Site\ExamController::class, 'answerMcqImageQuestion'])->name('inExam.answerMcqImageQuestion');
Route::post('/getExamCurrentResult', [App\Http\Controllers\Site\ExamController::class, 'getExamCurrentResult'])->name('inExam.getExamCurrentResult');
Route::get('/doReExam', [App\Http\Controllers\Site\ExamController::class, 'doReExam'])->name('inExam.doReExam');
Route::post('/markCurrentQuestionAsFlaged', [App\Http\Controllers\Site\ExamController::class, 'markCurrentQuestionAsFlaged'])->name('inExam.markCurrentQuestionAsFlaged');
Route::post('/saveExamResultAndDoAction', [App\Http\Controllers\Site\ExamController::class, 'saveExamResultAndDoAction'])->name('inExam.saveExamResultAndDoAction');
Route::post('/getFinishedExamResultUser', [App\Http\Controllers\Site\ExamController::class, 'getFinishedExamResultUser'])->name('inExam.getFinishedExamResultUser');
Route::post('/getFinishedExamResultGuest', [App\Http\Controllers\Site\ExamController::class, 'getFinishedExamResultGuest'])->name('inExam.getFinishedExamResultGuest');
Route::post('/getPreviewAnsweredQuestion', [App\Http\Controllers\Site\ExamController::class, 'getPreviewAnsweredQuestion'])->name('inExam.getPreviewAnsweredQuestion');
Route::post('/getPreviewAnsweredQuestionGuest', [App\Http\Controllers\Site\ExamController::class, 'getPreviewAnsweredQuestionGuest'])->name('inExam.getPreviewAnsweredQuestionGuest');
Route::post('/answerDragQuestion', [App\Http\Controllers\Site\ExamController::class, 'answerDragQuestion'])->name('inExam.answerDragQuestion');
Route::post('/showReportModel', [App\Http\Controllers\Site\ExamController::class, 'showReportModel'])->name('inExam.showReportModel');
Route::post('/reloadCurrentQuestion', [App\Http\Controllers\Site\ExamController::class, 'reloadCurrentQuestion'])->name('inExam.reloadCurrentQuestion');
Route::post('/reloadCurrentDragQuestion', [App\Http\Controllers\Site\ExamController::class, 'reloadCurrentDragQuestion'])->name('inExam.reloadCurrentDragQuestion');
Route::post('/makeExamFinish', [App\Http\Controllers\Site\ExamController::class, 'makeExamFinish'])->name('inExam.makeExamFinish');
Route::post('/makeCategoryFinishAndMovetoNextStep', [App\Http\Controllers\Site\ExamController::class, 'makeCategoryFinishAndMovetoNextStep'])->name('inExam.makeCategoryFinishAndMovetoNextStep');
Route::post('/jumpToQuestion', [App\Http\Controllers\Site\ExamController::class, 'jumpToQuestion'])->name('inExam.jumpToQuestion');
Route::post('/store-exam-problem', [App\Http\Controllers\Site\ExamController::class, 'siteStoreExamProblem'])->name('examOpinion.siteStoreExamProblem');
Route::post('/getprevExamFinish', [App\Http\Controllers\Site\ExamController::class, 'getprevExamFinish'])->name('getprevExamFinish');
Route::post('/getnextExamFinish', [App\Http\Controllers\Site\ExamController::class, 'getnextExamFinish'])->name('getnextExamFinish');
Route::post('/getprevExamFinishUser', [App\Http\Controllers\Site\ExamController::class, 'getprevExamFinishUser'])->name('getprevExamFinishUser');
Route::post('/getnextExamFinishUser', [App\Http\Controllers\Site\ExamController::class, 'getnextExamFinishUser'])->name('getnextExamFinishUser');
Route::post('/blogCommentStore', [App\Http\Controllers\HomeController::class, 'blogCommentStore'])->name('blogCommentStore');
Route::post('/getBlogComments', [App\Http\Controllers\HomeController::class, 'getBlogComments'])->name('getBlogComments');
Route::get('/theory-package/view/{id}', [App\Http\Controllers\HomeController::class, 'viewTheoryPackage'])->name('viewTheoryPackage');





Route::controller(ContactController::class)->group(function () {
    Route::post('contact', 'store')->name('contact.store');
});
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'page'])->name('page');
