<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            max-width: 500px;
            margin: auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Data Supplier</h2>

        <form action="{{ route('supplier.update', $supplier->id_sp) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Kode Supplier:</label>
            <input type="text" name="kode_supplier" value="{{ $supplier->id_sp }}" readonly>

            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>

            <label>Alamat:</label>
            <input type="text" name="alamat" value="{{ $supplier->alamat }}" required>

            <label>Kontak:</label>
            <input type="text" name="kontak" value="{{ $supplier->kontak }}" required>

            <button type="submit">Update</button>
        </form>

        <a href="{{ route('supplier.index') }}" class="back-link">← Kembali ke Daftar Supplier</a>
    </div>
</body>
</html>
