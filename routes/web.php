<?php

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\lecturer\CourseController as LecturerCourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MultipleChoiseController;
use App\Http\Controllers\PlaygroundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredLecturer;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentAssignmentController;
use Illuminate\Support\Facades\Route;

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

Route::controller(GuestController::class)->group(function () {
    Route::get("/", "index")->name("landingpage");
});

// HOME
Route::controller(HomeController::class)->group(function () {
    Route::get("/dashboard", "index")
        ->name("dashboard")
        ->middleware("auth");
});

// FILE
Route::controller(FileController::class)->group(function () {
    Route::post("/downloadTask/{slug}", "downloadTask")
        ->middleware("auth")
        ->name("downloadTask");
});

// Admin
Route::middleware(["auth", "role:super-admin"])->group(function () {
    Route::controller(CourseCategoryController::class)->group(function () {
        Route::get("/admin-categories", "index")->name("categories");
        Route::post("/admin-categories", "store")->name("categories.store");
        Route::delete("/admin-categories/{courseCategory:id}", "destroy")->name(
            "categories.destroy"
        );
        Route::put("/admin-categories/{courseCategory:id}", "update")->name(
            "categories.update"
        );
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get("/admin-course", "index")->name("courses");
        Route::get("/admin-course/create", "create")->name("courses.create");
        Route::post("/admin-course", "store")->name("courses.store");
        Route::get("/admin-course/{course:slug}/edit", "edit")->name(
            "courses.edit"
        );
        Route::put("/admin-course/{course:slug}", "update")->name(
            "courses.update"
        );
        Route::delete("/admin-course/{course:slug}", "destroy")->name(
            "courses.destroy"
        );
    });

    Route::controller(ModuleController::class)->group(function () {
        Route::get("/admin-module/{course:slug}", "index")->name("module");
        Route::get("/admin-module/{course:slug}/create", "create")->name(
            "module.create"
        );
        Route::post("/admin-module/{course:slug}", "store")->name(
            "module.store"
        );
        Route::get("/admin-module/{module:slug}/preview", "show")->name(
            "module.show"
        );
        Route::get("/admin-module/{module:slug}/edit", "edit")->name(
            "module.edit"
        );
        Route::put("/admin-module/{module:slug}", "update")->name(
            "module.update"
        );
        Route::delete("/admin-module/{module:slug}", "destroy")->name(
            "module.destroy"
        );
    });

    Route::controller(RegisteredLecturer::class)
        ->prefix("admin-lecturer")
        ->group(function () {
            Route::get("index", "index")->name("registeredLecturer");
            Route::get("create", "create")->name("registeredLecturer.create");
            Route::post("store", "store")->name("registeredLecturer.store");
            Route::delete("destroy/{user:id}", "destroy")->name(
                "registeredLecturer.destroy"
            );
        });

    Route::controller(MultipleChoiseController::class)
        ->prefix("admin-multiplechoise")
        ->group(function () {
            Route::get("index", "index")->name("multiplechoise");
            Route::post("store", "store")->name("multiplechoise.store");
            Route::get("index/{examClass:id}", "indexQuestion")->name(
                "multiplechoise.indexQuestion"
            );
            Route::get("question/{examClass:id}", "createQuestion")->name(
                "multiplechoise.createQuestion"
            );
            Route::post("question/{examClass:id}", "storeQuestion")->name(
                "multiplechoise.storeQuestion"
            );
            Route::get(
                "question/{multipleChoise:id}/edit",
                "editQuestion"
            )->name("multiplechoise.editQuestion");
            Route::put("question/{multipleChoise:id}", "updateQuestion")->name(
                "multiplechoise.updateQuestion"
            );
            Route::delete(
                "question/{multipleChoise:id}",
                "destroyQuestion"
            )->name("multiplechoise.destroyQuestion");
        });

    Route::controller(ReviewController::class)
        ->prefix("admin-reviews")
        ->group(function () {
            Route::get("/", "index")->name("adminReviews");
            Route::get("/uuid/{review:id}", "show")->name("adminReviews.show");
            Route::post("/uuid/{review:id}", "update")->name(
                "adminReviews.update"
            );
        });
});

Route::middleware(["auth", "role:lecturer"])
    ->prefix("lecturer")
    ->group(function () {
        Route::controller(RoomController::class)->group(function () {
            Route::get("/", "index")->name("rooms");
            Route::get("/create", "create")->name("rooms.create");
            Route::post("/", "store")->name("rooms.store");
            Route::get("/edit/{room:slug}", "edit")->name("rooms.edit");
            Route::put("/edit/{room:slug}", "update")->name("rooms.update");
            Route::delete("/destroy/{room:slug}", "destroy")->name(
                "rooms.destroy"
            );
            Route::get(
                "/student-assignments/{room:slug}",
                "studentAssigments"
            )->name("studentAssigments");
            Route::get(
                "/student-assignments/{slug}/view",
                "studentAssigmentsView"
            )->name("studentAssigmentsView");
        });

        Route::controller(LecturerCourseController::class)->group(function () {
            Route::get("/courses", "index")->name("lecturerCourse");
            Route::get("/review/{course:slug}", "reviewCourse")->name(
                "lecturerCourse.review"
            );
            Route::get("/review/module/{module:slug}", "reviewModule")->name(
                "lecturerCourse.reviewModule"
            );
            Route::get("/send/review/{course:slug}", "sendReview")->name(
                "lecturerCourse.sendReview"
            );
            Route::post("/send/review/{course:slug}", "storeReview")->name(
                "lecturerCourse.storeReview"
            );
            Route::get("/reviews", "indexReview")->name(
                "lecturerCourse.indexReview"
            );
            Route::get("/reviews/{review:id}", "showReview")->name(
                "lecturerCourse.showReview"
            );
        });
    });

// User
Route::middleware(["auth", "role:student|super-admin"])->group(function () {
    Route::controller(CourseStudentController::class)->group(function () {
        Route::get("/courses", "index")->name("coursesStudent");
    });

    Route::controller(LearnController::class)->group(function () {
        Route::get("/learn/{course:slug}", "index")->name("learn");
        Route::get("/learn/module/{module:slug}", "show")->name("learn.show");
        Route::post(
            "/learn/module/{module:slug}",
            "storeUserLearnedCourse"
        )->name("learn.storeUserLearnedCourse");
        Route::post(
            "/learn/module/{module:slug}/finished",
            "storeFisnishedModule"
        )->name("learn.storeFisnishedModule");
        Route::post(
            "/learn/module/{module:slug}/finished-course",
            "storeFisnishedCourse"
        )->name("learn.storeFisnishedCourse");
    });

    Route::controller(StudentAssignmentController::class)
        ->prefix("assigments")
        ->group(function () {
            Route::get("/", "index")->name("assignments");
            Route::get("/enter/room/{room:slug}", "enterRoom")->name(
                "enterRoom"
            );
            Route::post("/entered/room/{room:slug}", "enteredRoom")->name(
                "enteredRoom"
            );
            Route::get(
                "/collect/assigment/{assigment:slug}",
                "collectAssignment"
            )->name("collectAssignment");
            Route::post(
                "/collect/assigment/{assigment:slug}",
                "storeAssignment"
            )->name("storeAssignment");
            Route::get(
                "/collect/assigment/{assigment:slug}/sended",
                "collectAssignmentSended"
            )->name("collectAssignmentSended");
            Route::put(
                "/collect/assigment/{assigment:slug}/update",
                "storeAssignmentSended"
            )->name("storeAssignmentSended");
        });

    Route::controller(ExamController::class)
        ->prefix("exam")
        ->group(function () {
            Route::get("/start/{course:slug}", "index")->name("exam");
            Route::post("/submit/{course:slug}", "store")->name("exam.submit");
        });

    Route::controller(PlaygroundController::class)
        ->prefix("playground")
        ->group(function () {
            Route::get("/", "index")->name("playground");
        });
});

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

require __DIR__ . "/auth.php";
