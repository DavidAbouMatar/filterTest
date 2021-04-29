<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<form method="POST" action="/expenses/store">
    @csrf
    <div class="form-group row">
    <select class="form-control select2" style="width: 100%;" name="listing_id" required>
        <option selected="selected" value="">Select One</option>
        @foreach($Apartment  as  $apartment)
        <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group row">
        <label for="payment_period" class="col-sm-3 col-form-label">payment period</label>
        <div class="col-sm-9">
            <input type="date" id="payment_period" name="payment_period" required>
        </div>

        <div class="form-group row">
            <label for="currency" class="col-sm-3 col-form-label">Choose a car:</label>
            <select name="currency" id="currency" required>
                <option value="">None</option>
                <option value="LPB">LPB</option>
                <option value="usd">usd</option>
                <option value="EUR">EUR</option>
                <option value="AUD">AUD</option>
            </select>
        </div>
        <div class="form-group row">
      <label for="item" class="col-sm-3 col-form-label" >Item:</label>
      <input type="text" id="item" name="item" required>
        </div>
      <input type="submit" value="Submit">
    </form> 
    
</body>
</html>
