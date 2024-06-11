<?php

use App\Http\Controllers\MyData\UserController;
use App\Http\Controllers\MyData\RolesController;
use App\Http\Controllers\MyData\DepartmentsController;
use App\Http\Controllers\MyData\ProgramsController;
use App\Http\Controllers\MyData\StudentsController;
use App\Http\Controllers\MyData\RemarksController;
use App\Http\Controllers\MyData\HomeController;
use App\Http\Controllers\MyData\GownsController;
use App\Http\Controllers\MyData\TranscriptsController;
use App\Http\Controllers\MyData\CertificatesController;
use App\Http\Controllers\MyData\RecordsController;
use App\Http\Controllers\MyData\MessagesController;
use App\Http\Controllers\MyData\ChangePasswordController;
use Illuminate\Support\Facades\Route;

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
//Main Landing Page
Route::get('/', function () {
    return view('welcome');
});


  
//Auth Routes
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::post('/logoutroute', [App\Http\Controllers\MyData\UserController::class, 'perform'])->name('logoutroute');
 });

 
//Dashboard Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/hodHome', [App\Http\Controllers\HomeController::class, 'hodindex'])->name('hodHome');
Route::get('/registrarHome', [App\Http\Controllers\HomeController::class, 'registrarindex'])->name('registrarHome');
Route::get('/roHome', [App\Http\Controllers\HomeController::class, 'roindex'])->name('roHome');
Route::get('/financeHome', [App\Http\Controllers\HomeController::class, 'financeindex'])->name('financeHome');
Route::get('/librarianHome', [App\Http\Controllers\HomeController::class, 'libindex'])->name('librarianHome');
Route::get('/studentHome', [App\Http\Controllers\HomeController::class, 'studentindex'])->name('studentHome');
 
//Login View Routes
Route::get('/hodLogin', [App\Http\Controllers\MyData\UserController::class, 'login']);
Route::get('/registrarLogin', [App\Http\Controllers\MyData\UserController::class, 'registrarLogin']);
Route::get('/financeLogin', [App\Http\Controllers\MyData\UserController::class, 'financeLogin']);
Route::get('/roLogin', [App\Http\Controllers\MyData\UserController::class, 'recordsLogin']);
Route::get('/librarianLogin', [App\Http\Controllers\MyData\UserController::class, 'librarianLogin']);
Route::get('/studentLogin', [App\Http\Controllers\MyData\UserController::class, 'studentLogin']);
//Transcripts view by Registrar
Route::get('/transcripts', [App\Http\Controllers\MyData\TranscriptsController::class, 'transcriptsView']);
//Certificates view by Registrar
Route::get('/certificates', [App\Http\Controllers\MyData\CertificatesController::class, 'certificatesView']);
Route::get('/feesView', [App\Http\Controllers\MyData\RecordsController::class, 'feesViewShow']);

//Students Data view Routes
Route::get('/viewApprovedStudents', [App\Http\Controllers\MyData\StudentsController::class, 'selectApprovedList']);
Route::get('/approvedStudents', [App\Http\Controllers\MyData\StudentsController::class, 'getApprovedStudents'])->name('users.hod.approvedStudents');
Route::get('/nameConfirmation/{department_id}', [App\Http\Controllers\MyData\StudentsController::class, 'getStudentNames'])->name('users.hod.nameConfirm');
Route::get('/viewAll', [App\Http\Controllers\MyData\StudentsController::class, 'viewAllStudents'])->name('users.hod.viewAll');
Route::get('/viewAllStudents', [App\Http\Controllers\MyData\StudentsController::class, 'viewStudents'])->name('students.viewStudents');
Route::get('/graduationList/{department_id}', [App\Http\Controllers\MyData\StudentsController::class, 'graduationList'])->name('users.hod.graduationList');
Route::get('/createList/{department_id}', [App\Http\Controllers\MyData\StudentsController::class, 'createList'])->name('users.hod.createList');
Route::get("addRemarks/{department_id}/{student_id}", [StudentsController::class, "addRemarks"])->name("users.hod.addRemarks");
Route::get("viewRemarks/{department_id}/{student_id}", [StudentsController::class, "viewRemarks"])->name("users.hod.viewRemarks");
Route::get('/viewStudent/{student_id}', [App\Http\Controllers\MyData\StudentsController::class, 'viewStudent'])->name('users.hod.view');
Route::get('/feesPayment', [App\Http\Controllers\MyData\StudentsController::class, 'feesPaymentView'])->name('feesPayment');
Route::get('/clearStudentLibrary/{student_id}', [App\Http\Controllers\MyData\DepartmentsController::class, 'clearStudentLibView'])->name('users.librarian.clearStudentLibView');
Route::get('/clearanceStatus', [App\Http\Controllers\MyData\StudentsController::class, 'clearanceStatusProcessor'])->name('users.student.clearanceStatus');
Route::get('/clearApprovedStudents', [App\Http\Controllers\MyData\DepartmentsController::class, 'clearApprovedStudentsProcess'])->name('users.librarian.clearApprovedStudents');
Route::get('/clearanceProcess/{student_id}', [App\Http\Controllers\MyData\StudentsController::class, 'graduationStepsShow'])->name('clearanceProcess');
Route::get('/viewFinanceDetails', [App\Http\Controllers\MyData\FinanceController::class, 'viewFinanceDetailsView'])->name('users.finance.viewFinanceDetails');
Route::get('/clearViewFinance/{student_id}', [App\Http\Controllers\MyData\FinanceController::class, 'clearFinanceProcess'])->name('users.finance.clearViewFinance');

 
//LaikipiaHostels Logins: joel@laikipiahostels.com:Kiamalat8877:$2a$12$JmNybsXGgzRDqY0mUIj0N.5IHfG5jhpnQBOKWYAWsjsmYS.CJa1gm
//                        makumi@zalego.com::$2y$10$G/fuJKsfAJC7dqSKLogb5ewWKhDKrN0rftDdSePrWkqPbFNZxNXu. 

//All Resources
Route::resource('users', UserController::class);
Route::resource('roles', RolesController::class);
Route::resource('departments', DepartmentsController::class);
Route::resource('programs', ProgramsController::class);
Route::resource('gowns', GownsController::class);
Route::resource('records', RecordsController::class);
Route::resource('students', StudentsController::class);
Route::resource('remarks', RemarksController::class);
// Route::resource('certificates', CertificatesController::class);
// Route::resource('transcripts', TranscriptsController::class);


//Get Requests
Route::get('newGowns', [GownsController::class, 'createNew'])->name('newGowns');
Route::get('issuedGowns', [GownsController::class, 'issuedGownsView'])->name('issuedGowns');
Route::get('returnedGowns', [GownsController::class, 'returnedGownsView'])->name('returnedGowns');
Route::get('gownsInStore', [GownsController::class, 'index'])->name('gowns.index');
Route::get('createTrans', [RecordsController::class, 'createTransView'])->name('users.records.createTrans');
Route::get('createCert', [RecordsController::class, 'createCertView'])->name('users.records.createCert');
Route::get('clearStudentRecord', [RecordsController::class, 'clearStudentRecordProcess'])->name('clearStudentRecord');
Route::get('editRecord/{student_id}', [RecordsController::class, 'editRecordRecordProcess'])->name('editRecord');
Route::get('updateStudentRecords/{student_id}', [RecordsController::class, 'updateStudentRecordProcess'])->name('updateStudentRecords');
Route::get('viewRecord/{student_id}', [TranscriptsController::class, 'show'])->name('viewRecord');


Route::post('programs/{program_id}', [ProgramsController::class, 'update'])->name('programs.update');
Route::post('delTrans/{transcript_id}', [TranscriptsController::class, 'destroyTrans'])->name('delTrans');
Route::post('delCert/{certificate_id}', [CertificatesController::class, 'destroy'])->name('delCert');
Route::post('saveStudent', [StudentsController::class, 'saveStudents'])->name('students.saveStudent');
Route::post('clearStudentDept/{student_id}', [StudentsController::class, 'clearStudentDeptProcess'])->name('clearStudentDept');
Route::post('clearStuRecord/{email}', [RecordsController::class, 'clearStudRecordProc'])->name('clearStuRecord');
Route::post('addCert', [CertificatesController::class, 'store'])->name('addCert');
Route::post('addTrans', [TranscriptsController::class, 'store'])->name('addTrans');
Route::post('saveConfirm', [StudentsController::class, 'saveConfirmProcess'])->name('users.student.clearanceProcess');
Route::post('saveRemark', [StudentsController::class, 'saveRemarks'])->name('students.saveRemark');
Route::post('clearLibRecord/{student_id}', [DepartmentsController::class, 'clearLibRecordProcess'])->name('clearLibRecord');
Route::post('clearFinRecord/{student_id}', [DepartmentsController::class, 'clearLibRecordProcess'])->name('clearFinRecord');
Route::post('saveLibRecord', [DepartmentsController::class, 'saveLibRecordProcess'])->name('saveLibRecord');
Route::post('saveFees', [DepartmentsController::class, 'saveFeesProcess'])->name('saveFees');
Route::post('clearBook', [DepartmentsController::class, 'clearBookProcess'])->name('clearBook');
Route::post('selectGown/{gown_id}', [GownsController::class, 'selectGownProcess'])->name('selectGown');
Route::post('roles/{role}',[RolesController::class, 'update'])->name('roles.update');
Route::post('users/{user}/change-password',[ChangePasswordController::class, 'change_password'])->name('users.change.password');