const file_content = document.getElementById('std_image');
const lavel_btn = document.getElementById('label');
const tmp_content = document.getElementById('tmp_content');

file_content.addEventListener('change', () => {
	let tmpValue = file_content.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
	if (tmpValue) {
		tmp_content.innerHTML = tmpValue;
	}
});
