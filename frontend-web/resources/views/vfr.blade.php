<form action="/try-on" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Upload Your Photo:</label>
    <input type="file" name="user_image" required>
    
    <label>Select Clothing PNG:</label>
    <input type="file" name="cloth_image" required>
    
    <button type="submit">See How It Looks</button>
</form>