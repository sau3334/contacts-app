<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use SimpleXMLElement;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|unique:contacts|string|max:20'
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:contacts,phone_number,'.$contact->id,
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function importXML(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml|max:2048',
        ]);

        $xml = simplexml_load_file($request->file('xml_file')->getPathname());

        foreach ($xml->contact as $item) {
            Contact::updateOrCreate(
                ['phone_number' => (string) $item->phone],
                ['name' => (string) $item->name]
            );
        }

        return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully.');
    }
}
