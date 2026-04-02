<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            CRUD App
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

            <!-- TOP BAR -->
            <div class="flex justify-between mb-4">
                <input type="text" id="searchInput" placeholder="Search..."
                    class="border px-3 py-2 rounded w-1/3">

                <button onclick="openAddModal()"
                    class="bg-green-500 text-white px-4 py-2 rounded">
                    + Add User
                </button>
            </div>

            <!-- SUCCESS -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-2 mb-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TABLE -->
            <table class="w-full border">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">City</th>
                        <th class="p-2 border">Gender</th>
                        <th class="p-2 border">DOB</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2">{{ $post->id }}</td>
                    <td class="border p-2">{{ $post->name }}</td>
                    <td class="border p-2">{{ $post->email }}</td>
                    <td class="border p-2">{{ $post->phone_number }}</td>
                    <td class="border p-2">{{ $post->city }}</td>
                    <td class="border p-2">{{ $post->gender }}</td>
                    <td class="border p-2">{{ $post->dob }}</td>

                    <td class="border p-2 space-x-2">
                        <button onclick='openEditModal(@json($post))'
                            class="bg-blue-500 text-white px-2 py-1 rounded">
                            Edit
                        </button>

                        <button onclick="confirmDelete({{ $post->id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>

        </div>
    </div>

    <!-- ================= ADD MODAL ================= -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center overflow-y-scroll">
        <div class="bg-white p-6 rounded w-[700px]">

            <h2 class="text-lg mb-3">Add User</h2>

            <form id="addForm">
                @csrf

                <input name="name" placeholder="Name" class="border p-2 w-full mb-1">
                <input name="email" placeholder="Email" class="border p-2 w-full mb-1">
                <input name="phone_number" placeholder="Phone" class="border p-2 w-full mb-1">
                <input type="date" name="dob" class="border p-2 w-full mb-1">
                <input name="zipcode" placeholder="Zipcode" class="border p-2 w-full mb-1">
                <input name="role" placeholder="Role" class="border p-2 w-full mb-1">
                <textarea name="address" placeholder="Address" class="border p-2 w-full mb-1"></textarea>
                <input name="country" placeholder="Country" class="border p-2 w-full mb-1">
                <input name="state" placeholder="State" class="border p-2 w-full mb-1">
                <input name="city" placeholder="City" class="border p-2 w-full mb-1">

                <select name="gender" class="border p-2 w-full mb-2">
                    <option value="">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                <button type="button" onclick="closeAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- ================= EDIT MODAL ================= -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center overflow-y-scroll">
        <div class="bg-white p-6 rounded w-[700px]">

            <h2 class="text-lg mb-3">Edit User</h2>

            <form id="editForm">
                @csrf

                <input name="name" id="edit_name" class="border p-2 w-full mb-1">
                <input name="email" id="edit_email" class="border p-2 w-full mb-1">
                <input name="phone_number" id="edit_phone" class="border p-2 w-full mb-1">
                <input type="date" name="dob" id="edit_dob" class="border p-2 w-full mb-1">
                <input name="zipcode" id="edit_zipcode" class="border p-2 w-full mb-1">
                <input name="role" id="edit_role" class="border p-2 w-full mb-1">
                <textarea name="address" id="edit_address" class="border p-2 w-full mb-1"></textarea>
                <input name="country" id="edit_country" class="border p-2 w-full mb-1">
                <input name="state" id="edit_state" class="border p-2 w-full mb-1">
                <input name="city" id="edit_city" class="border p-2 w-full mb-1">

                <select name="gender" id="edit_gender" class="border p-2 w-full mb-2">
                    <option value="">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- ================= SCRIPTS ================= -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function openAddModal(){ document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal(){ document.getElementById('addModal').classList.add('hidden'); }
    function closeEditModal(){ document.getElementById('editModal').classList.add('hidden'); }

    function openEditModal(post){
        document.getElementById('editModal').classList.remove('hidden');

        document.getElementById('edit_name').value = post.name;
        document.getElementById('edit_email').value = post.email;
        document.getElementById('edit_phone').value = post.phone_number;
        document.getElementById('edit_dob').value = post.dob;
        document.getElementById('edit_zipcode').value = post.zipcode;
        document.getElementById('edit_role').value = post.role;
        document.getElementById('edit_address').value = post.address;
        document.getElementById('edit_country').value = post.country;
        document.getElementById('edit_state').value = post.state;
        document.getElementById('edit_city').value = post.city;
        document.getElementById('edit_gender').value = post.gender;

        document.getElementById('editForm').action = "/update/" + post.id;
    }

    document.getElementById('searchInput').addEventListener('keyup', function(){
        let value = this.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach(row=>{
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        });
    });

    function clearErrors(form){
        form.querySelectorAll('.error-text').forEach(el => el.remove());
    }

    function showErrors(errors, form){
        for(let field in errors){
            let input = form.querySelector(`[name="${field}"]`);
            if(input){
                let error = document.createElement("p");
                error.className = "text-red-500 text-xs error-text";
                error.innerText = errors[field][0];
                input.after(error);
            }
        }
    }

    document.getElementById("addForm").addEventListener("submit", function(e){
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);
        clearErrors(form);

        fetch("/form", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": csrf },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.errors){
                showErrors(data.errors, form);
            } else {
                Swal.fire("Success", data.message, "success").then(()=>location.reload());
            }
        });
    });

    document.getElementById("editForm").addEventListener("submit", function(e){
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);
        clearErrors(form);

        fetch(form.action, {
            method: "POST", // keep POST
            headers: { 
                "X-CSRF-TOKEN": csrf,            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.errors){
                showErrors(data.errors, form);
            } else {
                Swal.fire("Updated", data.message, "success").then(()=>location.reload());
            }
        });
    });

    function confirmDelete(id){
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true
        }).then((result)=>{
            if(result.isConfirmed){
                fetch("/delete/"+id, {
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": csrf }
                })
                .then(res => res.json())
                .then(data=>{
                    Swal.fire("Deleted", data.message, "success").then(()=>location.reload());
                });
            }
        });
    }
    </script>

</x-app-layout>