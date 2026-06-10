<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SalesController;

use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\ModulesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProductionIssuesController;
use App\Http\Controllers\Admin\ProductionReportController;
use App\Http\Controllers\Admin\RejectionUpdateController;
use App\Http\Controllers\Admin\RmPmProcurementUpdateController;
use App\Http\Controllers\Admin\StockReportController;
use App\Http\Controllers\Admin\UserRolesController;
use App\Http\Controllers\Admin\WhatsAppMessagingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FgPgFormulaController;
use App\Http\Controllers\Admin\OrderNDispatchController;
use App\Http\Controllers\Admin\ThresholdController;

use App\Http\Controllers\Admin\ShiftReportController;

use App\Http\Controllers\Admin\SalesTargetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("AuthInCheck", "RoleCheck")->group(function() {

    Route::get("/dashboard", [DashboardController::class, "showDashboard"])->name("dashboard"); 
    // -- Warehouse Entry Starts

    //** Dev URls Starts */
    Route::get("/warehouse/deleteShift", [WarehouseController::class, "deleteShift"]);
    //** Dev URLs Ends */

    Route::post("/warehouse/updateShift", [WarehouseController::class, "updateShift"]);
    Route::middleware("CheckShift")->group(function() {

        Route::get("/warehouse/profile", [WarehouseController::class, "profile"])->name("warehouse/profile");
        Route::get("/warehouse/rmpmentrystock", [WarehouseController::class, "rmpmentryStock"]);
        Route::post("/warehouse/rmpmentryStockDo", [WarehouseController::class, "rmpmentryStockDo"]);
        Route::get("/warehouse/rmpmentry", [WarehouseController::class, "rmpmentry"])->name("warehouse/rmpmentry");
        Route::post("/warehouse/rmpmentryDo", [WarehouseController::class, "rmpmentryDo"]);
        Route::get("/warehouse/getFgCatDataById", [WarehouseController::class, "getFgCatDataById"]);
        Route::get("/warehouse/getPreformOfFG", [WarehouseController::class, "getPreformOfFG"]);
        Route::get("/warehouse/setRmPmBasedOnPreform", [WarehouseController::class, "setRmPmBasedOnPreform"]);
        Route::get("/warehouse/rmpmstock", [WarehouseController::class, "rmpmstock"])->name("warehouse/rmpmstock");
        Route::get("/warehouse/fgstock", [WarehouseController::class, "fgstock"])->name("warehouse/fgstock");
        Route::get("/warehouse/production", [WarehouseController::class, "production"])->name("warehouse/production");
        Route::post("/warehouse/uploadProduction", [WarehouseController::class, "uploadProduction"]);
        Route::get("/warehouse/productionDelayAlert", [WarehouseController::class, "productionDelayAlert"]);
        Route::post("/warehouse/productionIssueUpload", [WarehouseController::class, "productionIssueUpload"]);
        Route::get("/warehouse/updateProductionTime", [WarehouseController::class, "updateProductionTime"]);
        Route::get("/warehouse/getProductionTimerUpdate", [WarehouseController::class, "getProductionTimerUpdate"]);
        // Route::get("/warehouse/stopProductionTimer", [WarehouseController::class, "stopProductionTimer"]);

        Route::get("/warehouse/rejection", [WarehouseController::class, "rejection"]);
        Route::post("/warehouse/uploadRejection", [WarehouseController::class, "uploadRejection"]);
        Route::get("/warehouse/addOrderDev", [WarehouseController::class, "addOrderDev"]);
        Route::get("/warehouse/order", [WarehouseController::class, "order"])->name("warehouse/order");
        Route::get("/warehouse/getOrderDetailsDataByOrderCode", [WarehouseController::class, "getOrderDetailsDataByOrderCode"]);
        Route::post("/warehouse/dispatchOrder", [WarehouseController::class, "dispatchOrder"]);
    });
    // -- Warehouse Entry Ends


    // -- Remaining Routes Start
    Route::get("/notification", [DashboardController::class, "notificationHandler"]);
    Route::get("/getProductionStatus", [DashboardController::class, "getProductionStatus"])->name("getProductionStatus");
    Route::get("/getUpdatesOfTheWarehouse", [DashboardController::class, "getUpdatesOfTheWarehouse"]);
    Route::get("/getNotificationUpdates", [DashboardController::class, "getNotificationUpdates"]);
    Route::get("/threshold", [ThresholdController::class, "showPage"]);
    Route::post("/updateThresholdRmPm", [ThresholdController::class, "updateThresholdRmPm"]);
    Route::post("/updateThresholdProduction", [ThresholdController::class, "updateThresholdProduction"]);
    Route::get("/rejectionUpdate", [RejectionUpdateController::class, "rejectionUpdate"])->name("rejectionUpdate");
    Route::post("/rejectionUpdateDo", [RejectionUpdateController::class, "rejectionUpdateDo"]);
    Route::get("/getSingleRejectionData", [RejectionUpdateController::class, "getSingleRejectionData"]);
    
    Route::get("/orderNDispatch", [OrderNDispatchController::class, "orderNDispatch"])->name("orderNDispatch");

    Route::post("/generateOrder", [OrderNDispatchController::class, "generateOrder"]);
    Route::get("/getOrderDetailsData", [OrderNDispatchController::class, "getOrderDetailsData"]);
    
    Route::post("/updatePaymentStatus", [OrderNDispatchController::class, "updatePaymentStatus"]);
    Route::post("/approvePayment", [OrderNDispatchController::class, "approvePayment"]);
    
    Route::get("/salesTarget", [SalesTargetController::class, "getSalesTargetData"])->name("salesTarget");
    Route::post("/generateTarget", [SalesTargetController::class, "generateTarget"]);
    Route::get("/rmPmProcurementUpdate", [RmPmProcurementUpdateController::class, "rmPmProcurementUpdate"]);
    Route::get("/stockReport", [StockReportController::class, "stockReport"])->name("stockReport");
    Route::get("/stockReport/rmPmWarehouseStock", [StockReportController::class, "rmPmWarehouseStock"])->name("stockReport/rmPmWarehouseStock");
    Route::get("/shiftReport", [ShiftReportController::class, "shiftReport"])->name("shiftReport");
    Route::get("/admin/stockreportexcel",[StockReportController::class, "stockReportExcel"]);
    Route::get("/productionReport", [ProductionReportController::class, "productionReport"]);
    Route::get("/userRole", [UserRolesController::class, "userRole"]);
    Route::get("/getUserDetailsOfRoleId", [UserRolesController::class, "getUserDetailsOfRoleId"]);
    Route::get("/modules", [ModulesController::class, "modules"]);

    Route::get("/permissions", [PermissionsController::class, "permissions"]);
    Route::get("/getRelatedRoleByModuleID", [PermissionsController::class, "getRelatedRoleByModuleID"]);
    
    Route::get("/email", [EmailController::class, "email"]);
    Route::get("/whatsAppMesaging", [WhatsAppMessagingController::class, "whatsAppMessaging"]);
    Route::get("/productionIssue", [ProductionIssuesController::class, "productionIssue"]);
    Route::post("/productionIssueDo", [ProductionIssuesController::class, "productionIssueDo"]);
    Route::get("/admin/profile", [ProfileController::class, "getProfileData"]);
    Route::get("/fgPmFormula", [FgPgFormulaController::class, "showfgPmFormula"]);
    Route::post("/fgPmFormulaUpload", [FgPgFormulaController::class, "fgPmFormulaUpload"]);
    Route::get("/getRmPmCatDataByID", [FgPgFormulaController::class, "getRmPmCatDataByID"]);

    Route::get("/sales/profile", [SalesController::class, "showProfile"]);

    // -- Remaining Routes Ends
    Route::get("/logout", [AuthController::class, "doLogout"]);
});

Route::middleware("AuthOutCheck")->group(function() {
    Route::get("/", [AuthController::class, "showLogin"])->name("/");
    Route::post("/doLogin", [AuthController::class, "doLogin"]);
});