 <?php
use App\Models\Commercant;
use Illuminate\Http\Request;

class CommercantController extends Controller
{
    // Acheter en gros
    public function acheterEnGros($id)
    {
        $commercant = Commercant::find($id);
        $commercant->acheter_en_gros = true;  // Met à jour acheter_en_gros
        $commercant->save();

        return response()->json($commercant);
    }

    // Gérer stock
    public function gererStock(Request $request, $id)
    {
        $commercant = Commercant::find($id);
        $commercant->stock = $request->stock;  // Mise à jour du stock
        $commercant->save();

        return response()->json($commercant);
    }
}
