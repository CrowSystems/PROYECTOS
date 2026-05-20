@php
    $ladas = [
        '+52' => 'México (+52)',
        '+1'  => 'EE.UU./Canadá (+1)',
        '+34' => 'España (+34)',
        '+57' => 'Colombia (+57)',
        '+54' => 'Argentina (+54)',
        '+56' => 'Chile (+56)',
        '+51' => 'Perú (+51)',
        '+55' => 'Brasil (+55)',
        '+49' => 'Alemania (+49)',
        '+81' => 'Japón (+81)',
        '+86' => 'China (+86)',
    ];
    $countries = ['México', 'Estados Unidos', 'Canadá', 'España', 'Colombia', 'Argentina', 'Chile', 'Perú', 'Brasil', 'Otro'];
    $mxStates = [
        'Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua',
        'Ciudad de México','Coahuila','Colima','Durango','Estado de México','Guanajuato','Guerrero',
        'Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro',
        'Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz',
        'Yucatán','Zacatecas',
    ];
@endphp

<section id="contacto" class="relative py-16 bg-cover bg-center"
         style="background-image: linear-gradient(rgba(220,220,220,.9), rgba(220,220,220,.9)), url('{{ asset('images/contact-bg.jpg') }}');">

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-start">

        {{-- Lado izquierdo --}}
        <div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#0e2540]">CONTÁCTANOS</h2>
            <h3 class="text-2xl md:text-3xl font-bold text-[#0e2540] mt-4">
                Transformamos tu productividad.<br>
                <span>¿Cómo te podemos apoyar?</span>
            </h3>
            <p class="text-slate-700 mt-4 max-w-md">
                Representamos marcas líderes y ofrecemos tecnología avanzada que optimizará tus procesos en la industria.
                Te apoyamos con tus necesidades CNC.
            </p>
            <p class="text-[#0e2540] font-bold mt-6">
                Llena el formulario, nos pondremos en contacto contigo.
            </p>
        </div>

        {{-- Formulario --}}
        <form action="{{ route('public.contact.store') }}" method="POST"
              class="bg-[#0e2540]/95 text-white p-6 md:p-8 rounded-xl shadow-xl space-y-3">
            @csrf

            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-300 text-red-100 text-sm rounded p-3">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Nombre *" required
                       class="bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Apellido *" required
                       class="bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">
            </div>

            <input type="text" name="company" value="{{ old('company') }}" placeholder="Empresa *" required
                   class="w-full bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">

            <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo empresarial *" required
                   class="w-full bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">

            <div class="grid grid-cols-3 gap-3">
                <select name="country_code" required
                        class="col-span-1 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-sky-300">
                    @foreach($ladas as $code => $label)
                        <option value="{{ $code }}" class="text-slate-800" @selected(old('country_code', '+52') === $code)>{{ $code }}</option>
                    @endforeach
                </select>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Móvil *" required
                       class="col-span-2 bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <select name="country" id="country-select" required onchange="toggleStateField(this.value)"
                        class="bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-sky-300">
                    <option value="" class="text-slate-800">País *</option>
                    @foreach($countries as $c)
                        <option value="{{ $c }}" class="text-slate-800" @selected(old('country') === $c)>{{ $c }}</option>
                    @endforeach
                </select>

                <select name="state" id="state-select"
                        class="bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-sky-300"
                        style="display: {{ old('country') === 'México' ? 'block' : 'none' }};">
                    <option value="" class="text-slate-800">Estado de la República *</option>
                    @foreach($mxStates as $st)
                        <option value="{{ $st }}" class="text-slate-800" @selected(old('state') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <textarea name="message" rows="4" required minlength="50"
                      placeholder="Mensaje (mínimo 50 caracteres) *"
                      class="w-full bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-sm placeholder-white/50 focus:outline-none focus:border-sky-300">{{ old('message') }}</textarea>

            <button type="submit"
                    class="w-full bg-sky-500 hover:bg-sky-600 text-white py-3 rounded-lg font-bold transition">
                Enviar
            </button>
        </form>
    </div>
</section>

<script>
    function toggleStateField(value) {
        const stateSel = document.getElementById('state-select');
        if (value === 'México') {
            stateSel.style.display = 'block';
            stateSel.required = true;
        } else {
            stateSel.style.display = 'none';
            stateSel.required = false;
            stateSel.value = '';
        }
    }
</script>
