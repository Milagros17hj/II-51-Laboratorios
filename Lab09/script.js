        // Canvas
        function draw() {
            const canvas = document.getElementById('canvasArea');
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#3498db';
            ctx.fillRect(10, 10, canvas.width - 20, canvas.height - 20);
            ctx.beginPath();
            ctx.arc(150, 100, 50, 0, 2 * Math.PI);
            ctx.fillStyle = '#e74c3c';
            ctx.fill();
        }

        //function draw2() {
            const canvas = document.getElementById('canvasArea2');
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.beginPath();
            ctx.rect(50, 50, 200, 100);
            ctx.lineWidth = 6;
            ctx.strokeStyle = 'red';
            ctx.stroke();
            ctx.beginPath();
            ctx.lineWidth = 10;
            ctx.strokeStyle = 'blue';
            ctx.rect(70, 70, 160, 60);
            ctx.stroke();
            ctx.beginPath();
            ctx.lineWidth = 2;
            ctx.strokeStyle = 'green';
            ctx.rect(30, 30, 60, 60);
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(150, 100, 20, 0, 2 * Math.PI);
            ctx.fillStyle = '#e74c3c';
            ctx.fill();
        //}

        // Drag and Drop
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }

        // FileReader
        function previewFile(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }