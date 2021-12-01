require('dotenv').config();
const p = require('child_process');

let app = new URL(process.env.APP_URL || 'http://localhost:8000');
let client = new URL(process.env.CLIENT_URL || 'http://localhost:3000');

console.log(`\n  ${client.href}\n`);

[`php artisan serve --port=${app.port}`, 'npm run dev'].forEach((command, index) => {
    console.log(`  [${index}] > ${command}`);

    let params = {
        cwd: __dirname,
    };

    let child = p.exec(command, params, function(error, stdout, stderr) {
        console.log('stdout: ' + stdout);
        console.log('stderr: ' + stderr);
        if (error == null) return;
        console.log('exec error: ' + error);
    });

    child.stdout.pipe(process.stdout);
});
