<form id="loginForm">
    @csrf
    <input type="email" id="email" placeholder="Email">
    <input type="password" id="password" placeholder="Password">
    <button type="submit">Login</button>
</form>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const res = await fetch('/api/login', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({email,password})
    });
    const data = await res.json();
    if(res.ok){
        localStorage.setItem('token', data.access_token);
        window.location.href='/dashboard';
    }else{
        alert(data.error || 'Error al iniciar sesión');
    }
});
</script>
