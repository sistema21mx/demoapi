<?php
// permite peticiones desde cualquier origen
header('Access-Control-Allow-Origin: *');
// permite peticiones con métodos GET, PUT, POST, DELETE y OPTIONS
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
// permite los headers Content-Type y Authorization
header('Access-Control-Allow-Headers: Content-Type, Authorization');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function () {
    return "Tested";
});

// estas rutas se pueden acceder sin proveer de un token válido.
Route::post('login', 'AuthController@login');

Route::get('/pdfview','PdfController@pdfView');
Route::get('/pdfview2','PdfController@pdfView2');
Route::get('/pdfdown','PdfController@pdfDown');

// estas rutas requiren de un token válido para poder accederse.
// 
Route::group(['middleware' => 'jwt.auth'], function () {
/*
    $middle = ['middleware' => 'jwt.auth'];
if (strpos(URL::current(), '127.0.0') !== false) {
    $middle = [];
}
Route::group($middle, function () {
*/
    Route::post('/userpassid', 'UserController@userPassId')->name('userpassid');

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    // Route::post('userall', 'UserController@userAll')->name('userall');

    Route::post('/profile/{id}', 'ProfileController@profile')->name('profile');
    Route::post('/profiluser', 'ProfileController@profilUser')->name('profiluser');
    Route::post('/profilsave', 'ProfileController@profilSave')->name('profilsave');

    Route::post('/menuprofile', 'MenuController@menuProfile')->name('menuprofile');
    Route::post('/menutype', 'MenuController@menuType')->name('menutype');
    Route::post('/menutypelist', 'MenuController@menuTypeList')->name('menutypelist');
    Route::post('/menupdate', 'MenuController@menUpdate')->name('menupdate');
    Route::post('/menucreate', 'MenuController@menuCreate')->name('menucreate');

    Route::post('userall', 'UserController@userAll')->name('userall');
    Route::post('userget/{id}', 'UserController@userGet')->name('userget');

    Route::post('useradd', 'UserController@userAdd')->name('useradd');
    Route::post('useredit/{id}', 'UserController@userEdit')->name('useredit');
    Route::post('userdel/{id}', 'UserController@userDel')->name('userdel');

    Route::post('/userlist','UserController@userList')->name('userlist');
    Route::post('/userupdate','UserController@userUpdate')->name('userupdate');
    Route::post('/setpass','UserController@setPass')->name('setpass');
    Route::post('/usercreate','UserController@userCreate')->name('usercreate');

    // Route::post('/companyretrive','CompaniaController@retrive')->name('companyretrive');
    Route::post('/companyretrive','CompanyController@retrive')->name('companyretrive');
    Route::post('/companyupdate','CompanyController@update')->name('companyupdate');

    Route::post('/logcreate','LogController@create')->name('logcreate'); 

    Route::post('/printest','TestprintController@printest')->name('printest');

    // Route::post('/customerlist','CustomerController@list')->name('customerlist');
    // Route::post('/customercreate','CustomerController@create')->name('customercreate');
    // Route::post('/customerupdate','CustomerController@update')->name('customerupdate');
    // Route::post('/customerprint','CustomerController@print')->name('customerprint');
    // Route::post('/customerids','CustomerController@ids')->name('customerids');
    // Route::post('/onetomany','CustomerController@onetomany')->name('onetomany');

    // Route::post('/doctorlist','DoctorController@list')->name('doctorlist');
    // Route::post('/doctorupdate','DoctorController@update')->name('doctorupdate');
    // Route::post('/doctorcreate','DoctorController@create')->name('doctorcreate');

    // Route::post('/patientall', 'PatientController@patientAll')->name('patientall');
    // Route::post('/patientupdate', 'PatientController@patientUpdate')->name('patientupdate');
    // Route::post('/patientcreate', 'PatientController@patientCreate')->name('patientcreate');

    // Route::post('/calist','CalendarController@calist');

    // Route::post('meetlist', 'AppointmentController@list');
    // Route::post('meetcalendar', 'AppointmentController@calendar');
    // Route::post('meetgroup', 'AppointmentController@group');
    // Route::post('meetcreate', 'AppointmentController@create');
    // Route::post('meetdel', 'AppointmentController@delete');
    // Route::post('meetupdate', 'AppointmentController@update');

    //

    Route::post('/budgetlist','BudgetController@list')->name('budgetlist');
    Route::post('/budgetcreate','BudgetController@create')->name('budgetcreate');
    Route::post('/budgetupdate','BudgetController@update')->name('budgetupdate');
    Route::post('/budgetsaveStat','BudgetController@stat')->name('budgetsaveStat');
    Route::post('/budgetids','BudgetController@ids')->name('budgetids');

    Route::post('/budgetinlist','BudgetIncomeController@list')->name('budgetinlist');
    Route::post('/budgetincreate','BudgetIncomeController@create')->name('budgetincreate');
    Route::post('/budgetinupdate','BudgetIncomeController@update')->name('budgetinupdate');
    Route::post('/budgetinsaveStat','BudgetIncomeController@stat')->name('budgetinsaveStat');
    Route::post('/budgetinids','BudgetIncomeController@ids')->name('budgetinids');

    Route::post('/budgetexlist','BudgetExpenditureController@list')->name('budgetexlist');
    Route::post('/budgetexcreate','BudgetExpenditureController@create')->name('budgetexcreate');
    Route::post('/budgetexupdate','BudgetExpenditureController@update')->name('budgetexupdate');
    Route::post('/budgetexsaveStat','BudgetExpenditureController@stat')->name('budgetexsaveStat');
    Route::post('/budgetexids','BudgetExpenditureController@ids')->name('budgetexids');




    Route::post('/condominialist','CondominiaController@list')->name('condominialist');
    Route::post('/condominiaupdate','CondominiaController@update')->name('condominiaupdate');
    Route::post('/condominiacreate','CondominiaController@create')->name('condominiacreate');
    Route::post('/condominiaids','CondominiaController@ids')->name('condominiaids');
    Route::post('/condominiaids2','CondominiaController@ids2')->name('condominiaids2');
    
    Route::post('/condominiaTypelist','CondominiaTypeController@list')->name('condominiaTypelist');
    Route::post('/condominiaTypeupdate','CondominiaTypeController@update')->name('condominiaTypeupdate');
    Route::post('/condominiaTypecreate','CondominiaTypeController@create')->name('condominiaTypecreate');
    Route::post('/condominiaTypeids','CondominiaTypeController@ids')->name('condominiaTypeids');
    
    Route::post('/condominiaQuotalist','CondominiaQuotaController@list')->name('condominiaQuotalist');
    Route::post('/condominiaQuotacreate','CondominiaQuotaController@create')->name('condominiaQuotacreate');
    Route::post('/condominiaQuotastate','CondominiaQuotaController@state')->name('condominiaQuotastate');
    
    Route::post('/quotalist','QuotaController@list')->name('quotalist');
    Route::post('/quotaupdate','QuotaController@update')->name('quotaupdate');
    Route::post('/quotacreate','QuotaController@create')->name('quotacreate');
    Route::post('/quotafindrow/{id}', 'QuotaController@findrow')->name('quotafindrow');

    
    Route::post('/providerlist','ProviderController@list')->name('providerlist');
    Route::post('/providerupdate','ProviderController@update')->name('providerupdate');
    Route::post('/providercreate','ProviderController@create')->name('providercreate');
    Route::post('/providerids','ProviderController@ids')->name('providerids');

    Route::post('/expenselist','ExpenseController@list')->name('expenselist');
    Route::post('/expenseids','ExpenseController@ids')->name('expenseids');
    Route::post('/expenseupdate','ExpenseController@update')->name('expenseupdate');
    Route::post('/expensecreate','ExpenseController@create')->name('expensecreate');
    Route::post('/expenseupdata','ExpenseController@updata')->name('expenseupdata');


    Route::post('/depositlist','DepositController@list')->name('depositlist');
    Route::post('/depositupdate','DepositController@update')->name('depositupdate');
    Route::post('/depositcreate','DepositController@create')->name('depositcreate');
    Route::post('/depositstate','DepositController@state')->name('depositstate');


    Route::post('/tenantlist','TenantController@list')->name('tenantlist');
    Route::post('/tenantupdate','TenantController@update')->name('tenantupdate');
    Route::post('/tenantcreate','TenantController@create')->name('tenantcreate');
    Route::post('/tenantids','TenantController@ids')->name('tenantids');
    
    Route::post('/ownerlist','OwnerController@list')->name('ownerlist');
    Route::post('/ownerupdate','OwnerController@update')->name('ownerupdate');
    Route::post('/ownercreate','OwnerController@create')->name('ownercreate');
    Route::post('/ownerids','OwnerController@ids')->name('ownerids');
    
    Route::post('/banklist','BankController@list')->name('banklist');
    Route::post('/bankupdate','BankController@update')->name('bankupdate');
    Route::post('/bankcreate','BankController@create')->name('bankcreate');
    Route::post('/bankids','BankController@ids')->name('bankids');

    Route::post('/eventlist','EventController@list')->name('eventlist');
    Route::post('/eventupdate','EventController@update')->name('eventupdate');
    Route::post('/eventcreate','EventController@create')->name('eventcreate');

    Route::post('/repairlist','RepairController@list')->name('repairlist');
    Route::post('/repairupdate','RepairController@update')->name('repairupdate');
    Route::post('/repaircreate','RepairController@create')->name('repaircreate');

    Route::post('/residencelist','ResidenceController@list')->name('residencelist');
    Route::post('/residenceupdate','ResidenceController@update')->name('residenceupdate');

    Route::post('/facilitieslist','FacilitiesController@list')->name('facilitieslist');
    Route::post('/facilitiesupdate','FacilitiesController@update')->name('facilitiesupdate');
    Route::post('/facilitiescreate','FacilitiesController@create')->name('facilitiescreate');

    Route::post('/vehiclelist','VehicleController@list')->name('vehiclelist');
    Route::post('/vehicleupdate','VehicleController@update')->name('vehicleupdate');
    Route::post('/vehiclecreate','VehicleController@create')->name('vehiclecreate');

    Route::post('/fundlist','FundController@list')->name('fundlist');
    Route::post('/fundupdate','FundController@update')->name('fundupdate');
    Route::post('/fundcreate','FundController@create')->name('fundcreate');
    Route::post('/fundids','FundController@ids')->name('fundids');

    Route::post('/visitlist','VisitlogController@list')->name('visitlist');
    Route::post('/visitupdate','VisitlogController@update')->name('visitupdate');
    Route::post('/visitcreate','VisitlogController@create')->name('visitcreate');






    // Route::post('/customerlist','CustomerController@list')->name('customerlist');
    // Route::post('/customercreate','CustomerController@create')->name('customercreate');
    // Route::post('/customerupdate','CustomerController@update')->name('customerupdate');
    // Route::post('/customerprint','CustomerController@print')->name('customerprint');
    // Route::post('/customerids','CustomerController@ids')->name('customerids');
    // Route::post('/onetomany','CustomerController@onetomany')->name('onetomany');

    // Route::post('/itemcustomer','ItemController@items')->name('itemcustomer');
    // Route::post('/itemupdate','ItemController@update')->name('itemupdate');
    // Route::post('/itemcreate','ItemController@create')->name('itemcreate');
    // Route::post('/itemids','ItemController@ids')->name('itemids');

    // Route::post('/companyretrive','CompaniaController@retrive')->name('companyretrive');
    Route::post('/companyretrive','CompanyController@retrive')->name('companyretrive');
    Route::post('/companyupdate','CompanyController@update')->name('companyupdate');

    // Route::post('/operatorlist','OperatorController@list')->name('operatorlist');
    // Route::post('/operatorupdate','OperatorController@update')->name('operatorupdate');
    // Route::post('/operatorcreate','OperatorController@create')->name('operatorcreate');
    // Route::post('/operatorids','OperatorController@ids')->name('operatorids');

    // Route::post('/vehiclelist','VehicleController@list')->name('vehiclelist');
    // Route::post('/vehicleupdate','VehicleController@update')->name('vehicleupdate');
    // Route::post('/vehiclecreate','VehicleController@create')->name('vehiclecreate');
    // Route::post('/vehicleids','VehicleController@ids')->name('vehicleids');
    
    // Route::post('/shipmentlastnumber','ShipmentController@lastNumber')->name('shipmentlastnumber');
    // Route::post('/shipmentcreate','ShipmentController@create')->name('shipmentcreate');
    // Route::post('/shipmentprint','ShipmentController@print')->name('shipmentprint');

    // Route::post('/shipmentjournal','ShipmenjController@journal')->name('shipmentjournal');
    // Route::post('/shipmentcancel','ShipmenjController@cancel')->name('shipmentcancel');
    // Route::post('/shipmentdelete','ShipmenjController@delete')->name('shipmentdelete');
    // Route::post('/shipmentpaid','ShipmenjController@paid')->name('shipmentpaid');
    // Route::post('/shipmentupdatecommamt','ShipmenjController@updatecommamt')->name('shipmentupdatecommamt');
    // Route::post('/shipmentpaycheck','ShipmenjController@paycheck')->name('shipmentpaycheck');
    // Route::post('/shipmentpayprint','ShipmenjController@payprint')->name('shipmentpayprint');
    
    // Route::post('/artrmlist','ArtrmController@list')->name('artrmlist');
    // Route::post('/artrmids','ArtrmController@ids')->name('artrmids');


    // Route::post('/invoicelastnumber','InvoiceController@lastNumber')->name('invoicelastnumber');
    // Route::post('/invoiceships','InvoiceController@shipments')->name('invoiceships');
    // Route::post('/invoicecreate','InvoiceController@create')->name('invoicecreate');

    // Route::post('/invoicejournal','InvoicejController@journal')->name('invoicejournal');
    // Route::post('/invoicejpaid','InvoicejController@paid')->name('invoicejpaid');
    // Route::post('/invoicejcancel','InvoicejController@cancel')->name('invoicejcancel');
    // Route::post('/invoicejdelete','InvoicejController@delete')->name('invoicejdelete');
    
    // Route::post('/artrmlist','ArtrmController@list')->name('artrmlist');
    // Route::post('/artrmupdate','ArtrmController@update')->name('artrmupdate');
    // Route::post('/artrmcreate','ArtrmController@create')->name('artrmcreate');
    // Route::post('/artrmids','ArtrmController@ids')->name('artrmids');


    /*
    Route::post('/providerids','ProviderController@ids')->name('providerids');
    */

    Route::post('/paymentcreate','PaymentController@create')->name('paymentcreate');
    Route::post('/paymentlist','PaymentController@list')->name('paymentlist'); 
    
    Route::post('/payreferlist','PayreferController@list')->name('payreferlist'); 
    Route::post('/payreferids','PayreferController@ids')->name('payreferids'); 
    Route::post('/payreferupdate','PayreferController@update')->name('payreferupdate'); 
    Route::post('/payrefercreate','PayreferController@create')->name('payrefercreate'); 

    Route::post('/paymentjournal','PaymentjController@journal')->name('paymentjournal');
    Route::post('/paymentcancel','PaymentjController@cancel')->name('paymentcancel');
    Route::post('/paymentpaid','PaymentjController@paid')->name('paymentpaid');

    Route::post('/logcreate','LogController@create')->name('logcreate'); 

    // Route::post('/loadfuellist','LoadfuelController@list')->name('loadfuellist');
    // Route::post('/loadfuelcreate','LoadfuelController@create')->name('loadfuelcreate');
    // Route::post('/loadfuelupdate','LoadfuelController@update')->name('loadfuelupdate');

    // Route::post('/loadpointids','LoadpointController@ids')->name('loadpointids'); 
    // Route::post('/loadpointlist','LoadpointController@list')->name('loadpointlist'); 
    // Route::post('/loadpointcreate','LoadpointController@create')->name('loadpointcreate'); 
    // Route::post('/loadpointupdate','LoadpointController@update')->name('loadpointupdate'); 

    // Route::post('/loanlist','LoanController@list')->name('loanlist');
    // Route::post('/loancreate','LoanController@create')->name('loancreate');
    // Route::post('/loanupdate','LoanController@update')->name('loanupdate');
    // Route::post('/loanactive','LoanController@active')->name('loanactive');

    // Route::post('/shiploadjournal','ShiploadjController@journal')->name('shiploadjournal');
    // Route::post('/shiploadpending','ShiploadjController@pending')->name('shiploadpending');

    // Route::post('/shiploadlist','ShiploadpayController@list')->name('shiploadlist');
    // Route::post('/shiploadcreate','ShiploadpayController@create')->name('shiploadcreate');

    Route::post('/printest','TestprintController@printest')->name('printest');



});