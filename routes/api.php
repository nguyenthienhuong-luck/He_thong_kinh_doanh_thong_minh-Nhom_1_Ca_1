use App\Http\Controllers\AnalysisController;
Route::middleware('auth:sanctum')->get('/analysis', [AnalysisController::class, 'index']);
