<div class="form-group">
    <label>Nom</label>
    <input type="text" name="nom" class="form-control" value="{{ old('nom', $livreur->nom ?? '') }}" required>
</div>

<div class="form-group">
    <label>Prénom</label>
    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $livreur->prenom ?? '') }}" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $livreur->email ?? '') }}" required>
</div>

<div class="form-group">
    <label>Téléphone</label>
    <input type="text" name="tel" class="form-control" value="{{ old('tel', $livreur->tel ?? '') }}" required>
</div>

<div class="form-group">
    <label>Adresse</label>
    <input type="text" name="adr" class="form-control" value="{{ old('adr', $livreur->adr ?? '') }}">
</div>

<div class="form-group">
    <label>Date d'embauche</label>
    <input type="date" name="date_embauche" class="form-control" value="{{ old('date_embauche', $livreur->date_embauche ?? '') }}">
</div>


<div class="form-group">
    <label>Statut</label>
    <select name="statut" class="form-control" required>
        @foreach($statuts as $statut)
            <option value="{{ $statut }}" {{ (old('statut', $livreur->statut ?? '') == $statut) ? 'selected' : '' }}>
                {{ ucfirst($statut) }}
            </option>
        @endforeach
    </select>
</div>
