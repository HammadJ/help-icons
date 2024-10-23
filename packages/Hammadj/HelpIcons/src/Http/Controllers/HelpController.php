<?php 
namespace Hammadj\HelpIcons\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hammadj\HelpIcons\Services\HelpIconService;


class HelpController extends Controller
{
    protected $helpIconService;

    public function __construct(HelpIconService $helpIconService)
    {
        $this->helpIconService = $helpIconService;
    }

    public function index()
    {
        $formId = 1; // Example, this could be dynamic based on route parameters
        $helpIcons = $this->helpIconService->getHelpIconsForForm($formId);
        return view('help.index', compact('helpIcons', 'formId'));
    }

    public function create()
    {
        return view('help.form');
    }
}
