import { useEffect, useState } from "react";

function App() {
  const [receptek, setReceptek] = useState([]);

  useEffect(() => {
fetch("http://localhost/CookQuest/api/receptek.php")
      .then(res => res.json())
      .then(data => setReceptek(data));
  }, []);

  


  return (
    
    <main className="min-h-screen bg-gradient-to-br from-[#95A792] to-[#7a8d78] py-8 px-4">
        <p className="text-white text-2xl">
  Receptek száma: {receptek.length}
</p>

      <div className="max-w-7xl mx-auto">
        <h1 className="text-4xl font-bold text-white mb-8 drop-shadow-lg">
          Fedezd fel és tanuld meg a receptjeinket!
        </h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
          {receptek.map(r => (
            <div
              key={r.ReceptID}
              className="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1"
            >
              <div className="relative overflow-hidden">
                <img
                  src={r.Kep}
                  alt={r.Nev}
                  className="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                />
                <div className="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                  <span className="text-sm text-[#596C68] font-bold">
                    ⭐ {r.BegyujthetoPontok}
                  </span>
                </div>
              </div>

              <div className="p-5">
                <div className="flex items-center gap-2 mb-2 flex-wrap">
                  <span className="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
                    {r.Szint}. SZINT
                  </span>
                  <span className="text-sm">
                    💰 {r.Koltseg} Ft
                  </span>
                </div>

                <h3 className="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">
                  {r.Nev}
                </h3>

                <div className="mt-4 flex items-center gap-4 text-sm text-gray-600">
                  <span>⏱️ {r.ElkeszitesiIdo}</span>
                </div>

                <button
                  className="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm"
                >
                  Recept megtekintése
                </button>
              </div>
            </div>
          ))}
        </div>
      </div>
    </main>
  );
}

export default App;
