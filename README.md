Mã nguồn thongbaomatcap.info 
====================
Đây là kho lưu trữ của dự án web xã hội Thongbaomatcap.info.

Là một dự án phi lợi nhuận và được viết trên framework CodeIgniter v3.x-dev.

Dự án đang trong giai đoạn phát triển ban đầu, mã nguồn được công khai trên github nên mọi lập trình viên đều có thể đóng góp nó hoàn thiện hơn.

Todo-list
---------------------
Hiện tại đang trong giai đoạn đầu phát triển, vì vậy công việc cần làm chưa được đề xuất.

Cài đặt
---------------------
Clone mã nguồn hiện tại về local, hoặc download tại [đây](https://github.com/anhsaker/thongbaomatcap/archive/master.zip). Giải nén, đưa thư mục lên server.

Sử dụng
---------------------
Framework có nâng cấp, bổ sung một số thư viện, helper... bạn cần biết nó để sử dụng như sau:

###Thư viện chuẩn

Hiện tại 4 lớp được kế thừa,  mở rộng thêm  `*`

- `MY_URI`
- `MY_Input`
- `MY_Model`
- `REST_Controller`

####Lớp MY_URI
Tích hợp thêm phương thức `is([$pattern])` chấp nhận một đối số truyền vào là 1 biểu thức mẫu.

Phương thức này sẽ trả về boolean nếu biểu thức truyền vào "giống" với địa chỉ URL hiện tại. Sử dụng `*` tương đương với bất kỳ ký tự nào.

Truyền vào một chuỗi
```php
if ( $this->uri->is('admin/*') )
{
    // ...
}
```

Hoặc sử dụng một mảng truyền vào 
```php
if ( $this->uri->is(array('admin/user*', 'admin/group*')) )
{
    // ...
}
```

####Lớp MY_Input
Bổ sung thêm phương thức `input([$type], [$xss_clean = FALSE])` chấp nhận 2 đối số truyền vào. Trả về lớp `Input_Data`.

- `$type` bắt buộc là `get` hoặc `post`. 
- `$xss_clean` có bật xss-clean dữ liệu không?

(*Dưới đây từ `input` đuợc coi như `$_GET` hoặc `$_POST`*)

Lấy tất cả input hiện có.
```php
$data = $this->input->input('get')->all();
```
Kiểm tra xem input có tồn tại?
```php
if ( $this->input->input('get')->has('page') )
{
    //...
}
```
Lấy một giá trị từ input. Tuơng tự như `$this->input->get('page')`;
```php
$page = $this->input->input('get')->get('page');
```
Chỉ lấy những key này từ input
```php
$data = $this->input->input('post')->only(array('page', 'start', 'limit'));
```
Lấy tất cả input ngoại trừ những key
```php
$data = $this->input->input('post')->except(array('captcha', 'csrf_token'));
```

Giấy phép
---------------------
Chúng tôi sử dụng giấy phép của [CodeIgniter](https://github.com/anhsaker/thongbaomatcap/blob/master/license.txt)
