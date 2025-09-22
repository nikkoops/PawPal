<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormQuestion;
use Illuminate\Http\Request;

class FormQuestionController extends Controller
{
    public function index()
    {
        $formQuestions = FormQuestion::orderBy('order')->get();
        return view('admin.form-questions.index', compact('formQuestions'));
    }

    public function create()
    {
        return view('admin.form-questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:500',
            'question_type' => 'required|in:text,textarea,select,radio,checkbox',
            'options' => 'nullable|array',
            'options.*' => 'string|max:255',
            'is_required' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $data = $request->all();
        
        // Set default order if not provided
        if (!isset($data['order'])) {
            $data['order'] = FormQuestion::max('order') + 1;
        }

        FormQuestion::create($data);

        return redirect()->route('admin.form-questions.index')->with('success', 'Question created successfully!');
    }

    public function edit(FormQuestion $formQuestion)
    {
        return view('admin.form-questions.edit', compact('formQuestion'));
    }

    public function update(Request $request, FormQuestion $formQuestion)
    {
        $request->validate([
            'question_text' => 'required|string|max:500',
            'question_type' => 'required|in:text,textarea,select,radio,checkbox',
            'options' => 'nullable|array',
            'options.*' => 'string|max:255',
            'is_required' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $formQuestion->update($request->all());

        return redirect()->route('admin.form-questions.index')->with('success', 'Question updated successfully!');
    }

    public function destroy(FormQuestion $formQuestion)
    {
        $formQuestion->delete();
        return redirect()->route('admin.form-questions.index')->with('success', 'Question deleted successfully!');
    }

    public function toggleActive(FormQuestion $formQuestion)
    {
        $formQuestion->update(['is_active' => !$formQuestion->is_active]);
        
        $status = $formQuestion->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Question {$status} successfully!");
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:form_questions,id',
            'questions.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->questions as $questionData) {
            FormQuestion::where('id', $questionData['id'])
                ->update(['order' => $questionData['order']]);
        }

        return response()->json(['success' => true]);
    }
}