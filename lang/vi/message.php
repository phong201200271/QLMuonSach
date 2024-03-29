<?php
return [
    'yearPublishValidateRequired' => 'Năm phát hành không được để trống',
    'yearPublishValidateInteger' => 'Năm phát hành phải là số nguyên',
    'yearPublishValidateMin' => 'Năm phát hành phải lớn hơn 0',

    'priceRentValidateRequired' => 'Giá thuê không được để trống',
    'priceRentValidateInteger' => 'Giá thuê phải là số nguyên',
    'priceRentValidateMin' => 'Giá thuê phải lớn hơn 0',

    'weightValidateRequired' => 'Trọng lượng không được để trống',
    'weightValidateInteger' => 'Trọng lượng phải là số nguyên',
    'weightValidateMin' => 'Trọng lượng phải lớn hơn 0',

    'totalPageValidateRequired' => 'Tổng số trang không được để trống',
    'totalPageValidateInterger' => 'Tổng số trang phải là số nguyên',
    'totalPageValidateMin' => 'Tổng số trang phải lớn hơn 0',

    'quantityValidateRequired' => 'Số lượng không được để trống',
    'quantityValidateInteger' => 'Số lượng phải là số nguyên',
    'quantityValidateMin' => 'Số lượng phải lớn hơn 0',

    'categoryChildrenValidateRequired' => 'Danh mục không được để trống',

    'thumbnailValidateRequired' => 'Ảnh của sách không được để trống',
    'thumbnailValidateMimes' => 'Ảnh của sách phải có phần mở rộng là jpg, png hoặc jpeg',
    'thumbnailValidateMax' => 'Ảnh của sách chỉ được có dung lượng tối đa là 4MB',

    'descriptionValidateRequired' => 'Mô tả sách không được để trống',

    'bookNameValidateRequired' => 'Tên của sách không được để trống',

    'authorIdValidateRequired' => 'Tác giả không được để trống',

    'authorNameValidateRequired' => 'Tên tác giả không được để trống',
    'authorNameValidateAlpha' => 'Tên tác giả phải là chữ',

    'authorNotAvailable' => 'Không có tác giả',
    'addAuthorSuccessfully' => 'Thêm tác giả thành công',

    'categoryNotAvailable' => 'Không có danh mục này',

    'updateBookSuccessfully' => 'Sửa sách thành công',
    'addBookSuccessfully' => 'Thêm sách thành công',
    'bookNotAvailable' => 'Sách không tồn tại',
    'lockBookSuccessfully' => 'Khóa sách thành công',
    'unlockBookSuccessfully' => 'Mở khóa sách thành công',
    'addBookToCartSuccessfully' => 'Thêm sách vào giỏ thành công',
    'rentBookSuccessfully' => 'Mượn sách thành công',

    'filterRangeYearValidateError' => 'Khoảng năm không hợp lệ',

    'dateRentRequired' => 'Ngày thuê không được bỏ trống',
    'dateRentDateFormat' => 'Ngày thuê không đúng định dạng',
    'dateRentAfter' => 'Ngày thuê tối thiểu phải là 1 ngày',

    'quantityRentRequired' => 'Số lượng thuê không được để trống',
    'quantityRentInteger' => 'Số lượng thuê phải là số nguyên',
    'quantityRentMin' => 'Số lượng thuê phải lớn hơn 0',
    'quantityRentMoreThanBookAvailable' => 'Số lượng mượn vượt quá sách trong kho',

    'validateSuccessfully' => 'Validate thành công',

    'requestRentBookNotAvailable' => 'Yêu cầu mượn sách không tồn tại',
    'acceptRequestRentBookSuccessfully' => 'Chấp nhận yêu cầu mượn sách thành công',
    'refuseRequestRentBookSuccessfully' => 'Từ chối yêu cầu mượn sách thành công' ,
    'markToReturnedRequestRentBookSuccessfully' => 'Đánh dấu người mượn đã trả sách thành công',

    'nameRequired' => 'Tên không được để trống',

    'mailRequired' => 'Địa chỉ email không được để trống',
    'mailEmail' => 'Sai định dạng email',
    'mailExist' => 'Email đã tồn tại',

    'dobRequired' => 'Ngày sinh không được để trống',
    'dobDateFormat' => 'Ngày sinh không đúng định dạng',

    'addressRequired' => 'Địa chỉ không được để trống',

    'passwordRequired' => 'Mật khẩu không được để trống',

    'confirmPasswordRequired' => 'Xác nhận mật khẩu không được để trống',

    'passwordNotMatch' => 'Mật khẩu và xác nhận mật khẩu không khớp',

    'registerAccountSuccessfully' => 'Đăng kí tài khoản thành công hãy vào email để kích hoạt tài khoản',

    'activeAccountSuccessfully' => 'Kích hoạt tài khoản thành công',

    'updateInformationSuccessfully' => 'Sửa thông tin thành công',

    'lockUserSuccessfully' => 'Khóa người dùng thành công',
    'unlockUserSuccessfully' => 'Mở khóa người dùng thành công',

    'verifyEmail' => 'Xác thực tài khoản',
    'resendVerifyEmailSuccessfully' => 'Gửi lại yêu cầu kích hoạt tài khoản thành công',

    'accountLocked' => 'Tài khoản của bạn đã bị khóa',

    'userNotExist' => 'Không tồn tại người dùng có email này',

    'forgotPassword' => 'Lấy lại mật khẩu',

    'resetPasswordSuccessfully' => 'Lấy lại mật khẩu thành công',
    'resendResetPasswordSuccessfully' => 'Gửi lại yêu cầu lấy lại mật khẩu thành công',

    'columnNameExcelRequired' => 'Cột name đang có ô trống',

    'columnYearPublishExcelRequired' => 'Cột year_publish đang có ô trống',
    'columnYearPublishExcelInteger' => 'Cột year_publish đang có ô không phải số nguyên',
    'columnYearPublishExcelMin' => 'Cột year_publish đang có ô không lớn hơn 0',

    'columnWeightExcelRequired' => 'Cột weight đang có ô trống',
    'columnWeightExcelInteger' => 'Cột weight đang có ô không phải số nguyên',
    'columnWeightExcelMin' => 'Cột weight đang có ô không lớn hơn 0',

    'columnPriceRentExcelRequired' => 'Cột price_rent đang có ô trống',
    'columnPriceRentExcelInteger' => 'Cột price_rent đang có ô không phải số nguyên',
    'columnPriceRentExcelMin' => 'Cột price_rent đang có ô không lớn hơn 0',

    'columnTotalPageExcelRequired' => 'Cột total_page đang có ô trống',
    'columnTotalPageExcelInteger' => 'Cột total_page đang có ô không phải số nguyên',
    'columnTotalPageExcelMin' => 'Cột total_page đang có ô không lớn hơn 0',

    'columnQuantityExcelRequired' => 'Cột quantity đang có ô trống',
    'columnQuantityExcelInteger' => 'Cột quantity đang có ô không phải số nguyên',
    'columnQuantityExcelMin' => 'Cột quantity đang có ô không lớn hơn 0',

    'columnCategoryChildrenExcelRequired' => 'Cột category_children đang có ô trống',

    'columnCategoryParentExcelRequired' => 'Cột category parent đang có ô trống',

    'columnAuthorExcelRequired' => 'Cột author đang có ô trống',

    'columnThumbnailExcelRequired' => 'Cột thumbnail đang có ô trống',

    'columnDescriptionExcelRequired' => 'Cột description đang có ô trống',
];
