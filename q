[1mdiff --git a/app/Http/Controllers/AdminController.php b/app/Http/Controllers/AdminController.php[m
[1mindex 741ec8c..b4c4c4a 100644[m
[1m--- a/app/Http/Controllers/AdminController.php[m
[1m+++ b/app/Http/Controllers/AdminController.php[m
[36m@@ -100,9 +100,9 @@[m [mpublic function destroy(User $user)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Admin successfully Removed',[m
[32m+[m[32m                'message' => 'Admin Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
     }[m
[31m-}[m
\ No newline at end of file[m
[32m+[m[32m}[m
[1mdiff --git a/app/Http/Controllers/BirthCodeController.php b/app/Http/Controllers/BirthCodeController.php[m
[1mindex 81f0eb7..8b67644 100644[m
[1m--- a/app/Http/Controllers/BirthCodeController.php[m
[1m+++ b/app/Http/Controllers/BirthCodeController.php[m
[36m@@ -83,7 +83,7 @@[m [mpublic function destroy(BirthCode $birthCode)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Brith Code successfully Removed',[m
[32m+[m[32m                'message' => 'Brith Code Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
[1mdiff --git a/app/Http/Controllers/ClinicController.php b/app/Http/Controllers/ClinicController.php[m
[1mindex 9be1945..eb75aec 100644[m
[1m--- a/app/Http/Controllers/ClinicController.php[m
[1m+++ b/app/Http/Controllers/ClinicController.php[m
[36m@@ -140,7 +140,7 @@[m [mpublic function destroy(Clinic $clinic)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Clinic successfully Removed',[m
[32m+[m[32m                'message' => 'Clinic Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
[1mdiff --git a/app/Http/Controllers/OrganizationController.php b/app/Http/Controllers/OrganizationController.php[m
[1mindex 707c745..4fd42ef 100644[m
[1m--- a/app/Http/Controllers/OrganizationController.php[m
[1m+++ b/app/Http/Controllers/OrganizationController.php[m
[36m@@ -82,7 +82,7 @@[m [mpublic function store(OrganizationRequest $request)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Organization successfully created',[m
[32m+[m[32m                'message' => 'Organization created',[m
                 'data' => $organization,[m
             ],[m
             Response::HTTP_CREATED[m
[36m@@ -134,7 +134,7 @@[m [mpublic function update([m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Organization successfully updated',[m
[32m+[m[32m                'message' => 'Organization updated',[m
                 'data' => $organization,[m
             ],[m
             Response::HTTP_OK[m
[36m@@ -157,7 +157,7 @@[m [mpublic function destroy(Organization $organization)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Organization successfully Removed',[m
[32m+[m[32m                'message' => 'Organization Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
[1mdiff --git a/app/Http/Controllers/SpecialistTypeController.php b/app/Http/Controllers/SpecialistTypeController.php[m
[1mindex 88c1e7f..469ed93 100644[m
[1m--- a/app/Http/Controllers/SpecialistTypeController.php[m
[1m+++ b/app/Http/Controllers/SpecialistTypeController.php[m
[36m@@ -83,7 +83,7 @@[m [mpublic function destroy(SpecialistType $specialistType)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'Specialist Type successfully Removed',[m
[32m+[m[32m                'message' => 'Specialist Type Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
[1mdiff --git a/app/Http/Controllers/UserRoleController.php b/app/Http/Controllers/UserRoleController.php[m
[1mindex da16f9b..80f9f70 100644[m
[1m--- a/app/Http/Controllers/UserRoleController.php[m
[1m+++ b/app/Http/Controllers/UserRoleController.php[m
[36m@@ -42,7 +42,7 @@[m [mpublic function store(UserRoleRequest $request)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'User Role successfully created',[m
[32m+[m[32m                'message' => 'User Role created',[m
                 'data' => $user_role,[m
             ],[m
             Response::HTTP_CREATED[m
[36m@@ -66,7 +66,7 @@[m [mpublic function update(UserRoleRequest $request, UserRole $userRole)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'User Role successfully updated',[m
[32m+[m[32m                'message' => 'User Role updated',[m
                 'data' => $userRole,[m
             ],[m
             Response::HTTP_OK[m
[36m@@ -85,7 +85,7 @@[m [mpublic function destroy(UserRole $userRole)[m
 [m
         return response()->json([m
             [[m
[31m-                'message' => 'User Role successfully Removed',[m
[32m+[m[32m                'message' => 'User Role Removed',[m
             ],[m
             Response::HTTP_NO_CONTENT[m
         );[m
[1mdiff --git a/routes/api.php b/routes/api.php[m
[1mindex 10a7517..14044d0 100644[m
[1m--- a/routes/api.php[m
[1m+++ b/routes/api.php[m
[36m@@ -38,9 +38,10 @@[m
         Route::apiResource('specialist-types', SpecialistTypeController::class);[m
         Route::apiResource([m
             'specialist-titles',[m
[31m-            SpecialistTypeController::class[m
[32m+[m[32m            SpecialistTitleController::class[m
         );[m
         Route::apiResource('birth-codes', BirthCodeController::class);[m
[32m+[m[32m        Route::apiResource('health-funds', HealthFundController::class);[m
     });[m
 [m
     Route::middleware(['ensure.role:organization-admin'])->group(function () {[m
