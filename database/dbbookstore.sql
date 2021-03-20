-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 20, 2021 lúc 08:19 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbbookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `book_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `book_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `img` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `promotion_price` double DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `description`, `price`, `img`, `pub_id`, `cat_id`, `promotion_price`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
('td01', 'Từ Điển mẫu câu tiếng Nhật', '<p>Tập hợp tất cả các mẫu câu tiếng Nhật. Phong phú, đầu đủ nhất.</p>', 450000, 'td01_Từ Điển mẫu câu tiếng Nhật.jpg', 'gd', 'td', 2235, '2021-02-27 17:30:44', NULL, '2021-03-20 22:44:23', NULL),
('td02', 'Từ Điển Kinh Doanh Và Tiếp Thị Hiện Đại', '<p>Quyển sách “Từ điển Kinh doanh – Tiếp thị Hiện đại” (Modern Business &amp; Marketing Dictionary) của tác giả Cung Kim Tiến (Bút danh Anh Tuấn) trình bày các thuật ngữ đang sử dụng thịnh hành trong giao dịch kinh doanh và tiếp thị trong nước và quốc tế. Đặc điểm của quyển sách là các thuật ngữ được đặt trong các bối cảnh khác nhau, bằng cách dẫn các đoạn văn xuất hiện trong thực tiễn kinh doanh quốc tế, giúp bạn đọc hiểu rõ được ý nghĩa và cách sử dụng trong thực tiễn của các thuật ngữ chuyên biệt này, với các nội dung thú vị khác nhau. Tác giả đã chọn lọc một cách công phu các đoạn văn đa dạng và phong phú, xuất hiện trên các ấn phẩm quốc tế khác nhau, giúp độc giả có cơ hội thuận lợi trong giao tiếp, soạn thảo, hoặc tham gia các buổi họp liên quan đến kinh doanh, đảm nhiệm các nhiệm vụ về kinh doanh, quản lý và tiếp thị trong các doanh nghiệp. Quyển sách này được kỳ vọng sẽ trợ giúp hiệu quả để bạn đọc tiếp cận một lĩnh vực tri thức kinh doanh bằng Anh ngữ, là bạn đồng hành trên con đường sự nghiệp trong thời kỳ quốc tế hóa.</p>', 195000, 'td02_Từ Điển Kinh Doanh Và Tiếp Thị Hiện Đại.jpg', 'vhtt', 'td', 9885, '2021-02-27 17:30:44', NULL, '2021-03-20 22:45:29', NULL),
('td03', 'Đại Từ Điển Tiếng Việt (Bản mới 2010)', '<p><i><strong>Thêm yêu tiếng Việt Từ lâu chúng ta đã có nhiều công trình nghiên cứu về kho tàng tiếng Việt, thế nhưng “Đại từ điển tiếng Việt” (NXB Đại học Quốc gia TPHCM - Nguyễn Như Ý chủ biên) vừa ra mắt bạn đọc là công trình đầy đặn và đồ sộ nhất. Cuốn sách đã bắt nhịp cầu cho những ai yêu tiếng mẹ… Cầm trên tay cuốn Đại từ điển dày gần 2.000 trang mới cảm nhận hết tâm huyết của những người làm sách. Cuốn từ điển này được in lần đầu tiên vào năm 1999, đến nay, đáp ứng nhu cầu của bạn đọc, các tác giả đã tiến hành nghiên cứu, bổ sung. Trong lần tái bản này, ban biên soạn đã chọn và đưa vào sách những từ ngữ mới xuất hiện và đã được dùng rộng rãi trong đời sống và trên các phương tiện thông tin đại chúng nhằm làm tăng tính mới mẻ và tiện ích cho người sử dụng. Một trong những ý tưởng chinh phục người đọc là tính đa dạng của Đại từ điển tiếng Việt. Bởi nó không chỉ đơn thuần là sự tra cứu nghĩa các từ mà mở ra chân trời kiến thức mới. Việc đan xen những kiến thức cơ bản về văn hóa, văn minh Việt Nam và thế giới, giới thiệu tổng quan và hệ thống các hiện vật văn hóa như: Đơn vị đo lường của Việt Nam và thế giới, đồng bạc Việt xưa và nay, các loại trống đồng hiện có ở Việt Nam, quốc kỳ các nước trên thế giới… Đây là những thông tin bổ ích đáp ứng nhu cầu bổ sung kiến thức cơ bản của học sinh - sinh viên và các bạn trẻ Việt Nam.</strong></i></p>', 450000, 'td03_Đại Từ Điển Tiếng Việt (Bản mới 2010).jpg', 'hcm', 'td', 2621, '2021-02-27 17:30:44', NULL, '2021-03-20 22:46:00', NULL),
('td05', 'Từ Điển Anh Việt - 75000 Từ', '<p>Từ điển mới ...</p>', 50000, 'td05_Từ Điển Anh Việt - 75000 Từ.jpg', 'hcm', 'td', 8789, '2021-02-27 17:30:44', NULL, '2021-03-20 22:53:08', NULL),
('td06', 'Từ điển địa danh hành chính Nam Bộ', 'Từ điển địa danh hành chính Nam Bộ do tác giả Nguyễn Đình Tư biên soạn hết sức công phu, tổng hợp được nhiều tư liệu quý, là công cụ giúp bạn đọc tra cứu một cách khoa học về địa danh hành chính. Đây là cuốn sách có giá trị không chỉ bởi nó cung cấp một lượng mục từ khá đồ sộ, mà còn bởi tác giả đã dành rất nhiều công sức và tâm huyết để sưu tầm, xử lý tư liệu về vùng đất có bề dày truyền thống lịch sử, nhưng cũng có sự thay đổi nhiều và phức tạp nhất về địa danh hành chính', 265000, 'td06.jpg', 'hcm', 'td', 3793, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th01', '100 thủ thuật với Excel 2010', '100 thủ thuật ứng với 100 bài tập thực hành được hướng dẫn, giải thích theo bố cục chặt chẽ, cách trình bày rõ ràng, dễ sử dụng, bạn đọc có thể tự mình xử lý những vấn đề nảy sinh trong quá trình thực hành đồng thời giúp các bạn thao tác nhanh trên bảng tính.\r\n', 54000, 'th01.gif', 'hcm', 'th', 2498, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th02', 'Lập trình web bằng PHP 5.3 và cơ sở dữ liệu', 'Tiếp theo tập 1, tập 2 của cuốn sách \"Lập trình Web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1\" bao gồm 10 chương và ứng dụng đính kèm lần lượt giới thiệu cùng bạn đọc các kiến thức liên quan đến Session, Cookie, giỏ hàng trực tuyến, tìm kiếm và phân trang dữ liệu, lập trình hướng đối tượng và sử dụng Zend Framework.\r\n\r\nChương 8 trình bày kiến thức cơ bản của kịch bản trình chủ PHP và cơ sở dữ liệu MySQL.\r\n\r\nSang chương 9, bạn tiếp tục tìm hiểu cách thiết kế trang Web cho phép người sử dụng tìm kiếm và phân trang dữ liệu trình bày với nhiều hình thức khác nhau.\r\n\r\nĐể xây dựng ứng dụng thương mại điện tử hoàn chỉnh và mang tính chuyên nghiệp cao, bạn tiếp tục tìm hiểu cách sử dụng hàm Session và Cookie trong chương 10 để lưu trữ thông tin của người sử dụng nhằm vào mục đích quản lý tài nguyên của Website.\r\n\r\nMọi ứng dụng thương mại điện tử đều cung cấp chương giỏ hàng trực tuyến, bạn cũng được tìm hiểu cách xây dựng giỏ hàng bằng cách sử dụng Session lẫn Cookie trong chương 11.\r\n\r\nKhi có nhu cầu trình bày hình ảnh, đồ thị và âm thanh lẫn phim ảnh, bạn tìm hiểu cách sử dụng mã PHP trong chương 12.\r\n\r\nTiếp theo, bạn có thể tìm hiểu cú pháp của kịch bản PHP trong chương 13 và học cách lập trình hướng đối tượng và sử dụng lớp này vào ứng dụng trong chương 14.\r\n\r\nChương 15 giúp bạn sử dụng kịch bản trình khách Java Script để thay đổi góc nhìn và ứng xử của thẻ HTML trong trang Web.\r\n\r\nSang chương 16, bạn khám phá thư viện mã nguồn mở Zend viết bằng PHP dùng cho các loại cơ sở dữ liệu và học cách sử dụng các lớp trong thư viện này vào ứng dụng bán hàng trực tuyến trong chương 17.', 76000, 'th02.jpg', 'hcm', 'th', 1013, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th03', 'Lập trình web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1 (Tập1)', 'Tập 1 của cuốn sách \"Lập trình Web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1\" bao gồm 7 chương và ứng dụng đính kèm. Chương 1 cung cấp cho bạn kiến thức từ chức năng của Website, cài đặt gói WamSever 2.0 và cấu hình để có thể vận hành ứng dụng Web bằng PHP, MySQL và Apache Web Sever.\r\n\r\nSang chương 2, bạn tiếp tục tìm hiểu cách tạo Website và thiết kế cấu trúc dùng cho doanh nghiệp bằng hệ quản trị nội dung mã nguồn mở Joomla. Nhằm thỏa mãn nội dung trình bày, bạn tiếp tục tìm hiểu cách thiết kế trang Web tĩnh hay động bằng mã tự sinh PHP với phần mềm Dreamweaver CS trong chương 3 và thẻ HTML trong chương 4.\r\n\r\nTiếp theo, bạn có thể tìm hiểu cú pháp của kịch bản PHP trong chương 5 và học cách sử dụng ứng dụng PhpMyAdmin để quản trị cơ sở dữ liệu MySQL trong chương 6. Sang chương 7 bạn tìm hiểu phát biểu SQL của cơ sở dữ liệu MySQL dùng để xây dựng ứng dụng bán hàng trực tuyến.', 76000, 'th03.jpg', 'hcm', 'th', 7471, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th04', 'Làm Quen Với Internet', 'Ngày nay với sự phát triển không ngừng của kinh tế nói chung và ngành công nghệ thông tin nói riêng, chúng ta có thể dễ dàng tiếp xúc và làm quen với máy vi tính. Tuy nhiên đây là một lĩnh vực mới lại chưa được phổ cập ở mọi cấp học nên các em sẽ có cảm giác bỡ ngỡ, thiếu tự tin khi lần đầu làm quen với chiếc máy tính đa năng. Mỗi bài học trong cuốn sách là một bài thực hành, được thực hiện qua từng bước cơ bản với hình ảnh minh họa trực quan và những lời giải thích chi tiết.', 31000, 'th04.jpg', 'hcm', 'th', 4219, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th05', 'Từng Bước Làm Quen Với Máy Tính', 'Mục Lục:\r\n\r\nBài 1: Máy tính điện tử và hệ điều hành\r\n\r\nBài 2: Hệ điều hành Window XP\r\n\r\nBài 3: Làm việc với máy tính qua desktop\r\n\r\nBài 4: Tệp tin và thư mục\r\n\r\nBài 5: Sử dụng Window Explorer\r\n\r\nBài 6: Một số thao tác cần biết\r\n\r\nPhụ lục – Những tổ hợp phím tắt', 31000, 'th05.jpg', 'vhtt', 'th', 8580, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th06', 'Quản Trị Windows Server 2008 - Tập 2', 'Kế thừa những ưu điểm vượt trội và sự thành công của Windows Server 2003 cùng những phiên bản Windows trước đó, hãng Microsoft tiếp tục cho ra đời một phiên bản hệ điều hành dành cho máy chủ mới, Windows Server 2008. Phiên bản này đem đến cho người dùng sự nhanh chóng trong cài đặt; sự tiện lợi trong quản trị hệ thống, tương tác với các thành phần và dịch vụ vì được tập trung vài một công cụ duy nhất – Server Manager, những cải tiến đáng chú ý trên Windows Firewall; công nghệ ảo hoá…\r\n\r\nWindows Server 2008 còn cung cấp cho người sử dụng cách thức cài đặt Server Core, bao gồm những thành phần cơ bản nhất của Windows Server và giao diện dòng lệnh. Với kiểu cài đặt này, giao diện đồ hoạ quen thuộc của Windows cùng những dịch vụ không cần thiết sẽ không được cài đặt lên hệ thống. Nhờ đó nâng cao độ bảo mật và nâng cấp hệ thống.', 62000, 'th06.jpg', 'hcm', 'th', 143, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th07', 'Kỹ Thuật Lập Trình C - Cơ Sở Và Nâng Cao', ' Cuốn sách này gồm những nội dung chính sau:\r\n# Chương 1: Các khái niệm cơ bản\r\n# Chương 2: Hằng biến và mảng\r\n# Chương 3: Biểu thức\r\n# Chương 4: Vào ra\r\n# Chương 5: Các toán tử điều khiển\r\n# Chương 6: Hàm và cấu trúc chương trình\r\n# Chương 7: Cấu trúc\r\n# Chương 8: Quản lý màn hình và cửa sổ\r\n# Chương 9: Đồ họa\r\n# Chương 10: Thao tác trên các tập tin\r\n# Chương 11: Lưu trữ dữ liệu và tổ chức bộ nhớ chương trình\r\n# Chương 12: Các chỉ thị tiền xử lý\r\n# Chương 13: Sử dụng ngắt trong C\r\n# Chương 14: Truy nhập trực tiếp vào bộ nhớ\r\n# Chương 15: Hàm xử ngắt và chương trình thường trú\r\n# Chương 16: Âm thanh, âm nhạc\r\n# Chương 17: Lập trình theo thời gian, theo sự kiện và trò chơi\r\n# Chương 18: Giao diện giữa C và Assembler\r\n# Phụ lục 1: Quy tắc xuống dòng và sử dụng các khoảng trống khi viết chương trình\r\n# Phụ lục 2: Tóm tắt các hàm chuẩn của Turbo C\r\n# Phụ lục 3: Bảng mã ASCII\r\n# Phụ lục 4: Cài đặt Turbo C vào đĩa cứng\r\n# Phụ lục 5: Hướng dẫn sử dụng môi trường kết hợp Turbo C\r\n# Phụ lục 6: Hệ soạn thảo của Turbo C\r\n# Phụ lục 7: Dùng menu project dịch chương trình trên nhiều tệp\r\n# Phụ lục 8: Dịch chương trình theo chế độ dòng lệnh TCC\r\n# Phụ lục 9: Sửa đổi cú pháp và gỡ rối chương trình\r\n# Phụ lục 10: Các mô hình bộ nhớ\r\n# Phụ lục 11: Danh sách các hàm của Turbo C theo thứ tự ABC\r\n# Phụ lục 12: Hàm với đối số bất định trong C\r\n# Phụ lục 13: Một số chương trình hữu ích', 72000, 'th07.jpg', 'tn', 'th', 4875, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th08', 'Giáo Trình Học Nhanh SQL Server 2008 - Tập 2', 'Bộ sách “Giáo trình học nhanh SQL Server 2008” được biên soạn dành cho các nhà phát triển và các nhà quản trị cơ sở dữ liệu, những người đang công tác trong lĩnh vực quản lý dữ liệu doanh nghiệp và cho tất cả những ai quan tâm đến SQL Server 2008.\r\n\r\n\r\nVới cách thiết kế và bố cục rõ ràng theo từng chủ điểm cụ thể, bộ sách tập trung trình bày những tính năng chính của SQL Server 2008 nhằm mục đích giúp bạn đọc tăng cường kiến thức đồng thời nâng cao kỹ năng sử dụng sản phẩm mới rất tuyệt vời này. Bộ sách được chia thành 2 tập với bốn phần chính sau đây:', 81000, 'th08.jpg', 'hcm', 'th', 3848, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th09', '160 Vấn Đề Cần Nên Biết Khi Sử Dụng Đồ Họa Máy Vi Tính', '\"160 Vấn Đề Cần Nên Biết Khi Sử Dụng Đồ Họa Máy Vi Tính\" bao gồm những vấn đề cơ bản và thiết yếu mà những người đang học hay làm đồ họa máy vi tính thường quan tâm tìm hiểu nhằm làm việc hiệu quả hơn với các chương trình phần mềm như Photoshop, CorelDRAW và Illustrator.\r\n\r\n\r\nSách gồm 3 phần, được thiết kế và bố cục theo từng vấn đề cụ thể từ cơ bản đến chuyên nghiệp như tùy biến Photoshop cho các dự án mà bạn thực hiện, chỉnh sửa các bức ảnh chân dung, tạo nên điều kỳ diệu với những hiệu ứng số đặc biệt, trình bày hình ảnh một cách chuyên nghiệp, tạo các thiết kế và viết lời truyện tranh trong CorelDRAW, và áp dụng các hiệu ứng với Illustrator.\r\n\r\n\r\nSách được trình bày ngắn gọn, rõ ràng kèm hình ảnh minh họa. Ngoài ra sách còn bao gồm nhiều thủ thuật và lưu ý hữu ích.', 85000, 'th09.jpg', 'tn', 'th', 4517, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th10', 'Giáo Trình Học Nhanh SQL Server 2008 - Tập 1', 'Bộ sách “Giáo trình học nhanh SQL Server 2008” được biên soạn dành cho các nhà phát triển và các nhà quản trị cơ sở dữ liệu, những người đang công tác trong lĩnh vực quản lý dữ liệu doanh nghiệp và cho tất cả những ai quan tâm đến SQL Server 2008.\r\n\r\n\r\nVới cách thiết kế và bố cục rõ ràng theo từng chủ điểm cụ thể, bộ sách tập trung trình bày những tính năng chính của SQL Server 2008 nhằm mục đích giúp bạn đọc tăng cường kiến thức đồng thời nâng cao kỹ năng sử dụng sản phẩm mới rất tuyệt vời này.', 69000, 'th10.jpg', 'tn', 'th', 941, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th11', 'Microsoft Word 2007 - Căn Bản Và Thủ Thuật', 'Microsoft Word 2007 nói riêng và Microsoft Office 2007 nói chung có nhiều đổi mới. Microsoft chẳng những cung cấp cho người dùng giao diện đẹp mắt mà còn có nhiều tiện ích và trực quan hơn so với các phiên bản trước đây. Thay cho thanh menu và các thanh dụng cụ là một hệ thống Ribbon bao gồm các thẻ, các nhóm, trong từng menu lại có các menu phụ và các lệnh. Khi bạn trỏ chuột vào biểu tượng nào của hệ thống này sẽ hiển thị ScreenTip cho biết chức năng và công dụng của chúng. Chẳng những thế, Word còn thể hiện tức thời hiệu quả của từng lệnh để bạn xem, trước khi chọn chúng.\r\n\r\n\r\nTrong quyển sách này, chúng tôi trình bày tóm tắt lý thuyết căn bản về soạn thảo, chỉnh sửa, định dạng văn bản và một số thủ thuật mà bất cứ ai làm công tác văn phòng đều phải sử dụng. Nội dung sách gồm 6 bài: 1-Thủ thuật tổng quát, 2-Soạn thảo và chỉnh sửa văn bản, 3-Định dạng văn bản, 4-WordArt và xử lý hình ảnh, 5-Liên kết và Web, 6-Bảo mật & in ấn văn bản,. Từ bài 2 đến bài 4, trước khi trình bày thủ thuật, chúng tôi tóm tắt lý thuyết giống như giáo trình Word 2007 để bạn thực hành', 69000, 'th11.jpg', 'gd', 'th', 1053, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th12', 'Kế Toán Doanh Nghiệp Với ACCESS', 'Sách mới...', 76000, 'th12.jpg', 'gd', 'th', 2342, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th13', 'Giáo Trình C++ & Lập Trình Hướng Đối Tượng', 'Cuốn sách gồm 12 chương và 7 phụ lục:\r\n\r\nChương 1 hướng dẫn cách làm việc với phần mềm TC++ 3.0 để thử nghiệm các chương trình, trình bày sơ lược về các phương pháp lập trình và giới thiệu một số mở rộng đơn giản của C.\r\n\r\nChương 2 trình bày các khả năng mới trong việc xây dựng và sử dụng hàm trong C++ như biến tham chiếu, đối có kiểu tham chiếu, đối có giá trị mặc định, hàm trực tuyến, hàm trùng tên, hàm toán tử.\r\n\r\nChương 3 nói về một khái niệm trung tâm của lập trình hướng đối tượng là lớp gồm: Định nghĩa lớp, khai báo các biến, mảng đối tượng ( kiểu lớp ), phương pháp, dùng con trỏ this trong phương thức, phạm vi truy xuất của các thành phần, các phương thức toán tử.\r\n\r\nChương 4 trình bày các vấn đề tạo dựng, sao chép, huỷ bỏ các đối tượng và các vấn đề khác có liên quan như: Hàm tạo, hàm tạo sao chép, hàm huỷ, toán tử gán, cấp phát bộ nhớ cho đối tượng, hàm bạn, lớp bạn.\r\n\r\nChương 5 trình bày một khái niệm quan trong tạo nên khả năng mạnh của lập trình hướng đối tượng trong việc phát triển, mở rộng phầm mềm, đó là khả năng thừa kế củaw các lớp.\r\n\r\nChương 6 trình bày một khái niệm quan trọng khác cho phép xử lý các vấn đề khác nhau, các thực thể khác nhau, các thuật toán khác nhau theo cùng một lược đồ thống nhất, đó là tính tướng ứng bội và phương thức ảo. Các công cụ này cho phép dễ dàng tổ chức chương trình quản lý nhiều dạng đối tượng khác nhau.\r\n\r\nChương 7 trình bày các thao tác trên tệp như: tạo một tệp mới, ghi dữ liệu từ bộ nhớ lên tệp, đọc dữ liệu từ tệp vào bộ nhớ...\r\n\r\nChương 8 nói về việc tổ chức vào/ ra trong C++.C++ đưa vào một khái niệm mới gọi là các dòng tin ( Stream ), Các thao tác vào/ra sẽ thực hiện trao đổi dữ liệu giữa các bộ nhớ với dòng tin: Vào là chuyển dữ liệu từ dòng nhập vào bộ nhớ, ra là chuyển dữ liệu từ bộ nhớ lên dòng xuất. Để nhập xuất dữ liệu trên một thiết bị cụ thể nào, ta chỉ cần gắn dòng nhập xuất với thiết bị đó. Việc tổ chức vào ra theo cách như vậy là rất khoa học và tiện lợi vì nó có tính độc lập thiết bị.\r\n\r\nChương 9 trình bày các hàm đồ hoạ sử dụng trong C và C++. Các hàm này được sử dụng rải rác trong toàn bộ cuốn sách để xây dựng các đối tượng đồ hoạ.\r\n\r\nChương 10 trình bày các hàm truy xuất trực tiếp vào bộ nhớ của máy tính, trong đó có bộ nhớ màn hình. Các hàm này sẽ được sử dụng trong chương 11 để xây dựng các lớp menu và cửa sổ.\r\n\r\nChương 11 giới thiệu 5 chương trình tương đối hoàn chỉnh nhằm minh hoạ thêm khả năng và kỹ thuật lập trình hướng đối tượng trên C++.\r\n\r\nChương 12 trình bày thêm một số chương trình đối tượng trên C++. Đây là các chương trình tương đối phức tạp, hữu ích và sử dụng các công cụ mạnh của C++.', 78000, 'th13.gif', 'gd', 'th', 8451, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th14', 'Các Thủ Thuật Trong HTML Và Thiết Kế Web', 'Cuốn sách này sẽ cung cấp các thông tin cần thiết để đẩy nhanh tốc độ thiết kế Web thông qua việc thực hành với các mẫu của nhiều chuyên gia thiết kế Web.\r\nCuốn sách tập trung vào các chi tiết để tạo ra các Web site tốt thông qua nhiều cách tiếp cận hiện đại để giải quyết các thách thức liên quan đến việc tạo Web site. Thay vì đi vào từng ngôn ngữ và công nghệ cụ thể, các bài học trong cuốn sách này được phân chia thành các \"thủ thuật\" nhằm giúp bạn:\r\n# Ngay lập tức cải thiện được Web site của mình\r\n# Xây dựng Web site mới thật sinh động, tương thích với nhiều môi trường khác nhau\r\n# Quản lý việc thiết kế lại\r\n# Đưa Web site từ khởi đầu đến thành công', 89000, 'th14.jpg', 'gd', 'th', 5130, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th15', 'Tạo Website Hấp Dẫn Với HTML, XHTML Và CSS', 'Ngày nay, việc ứng dụng phát triển Website hấp dẫn không còn gói gọn bằng HTLM, cho dù bạn đang xây dựng một Website thương mại phức tạp hoặc chỉ đơn thuần là tạo ra một Website nhỏ cho bản thân. Với cuốn sách \"Tạo Website Hấp Dẫn Với HTML, XHTML Và CSS\"  này sẽ cùng bạn khám phá các sắc thái của XHTML và CSS theo cách giúp bạn nắm được các vấn đề. Sách bao gồm nhiều thông tin mới cập nhật về XHTML, CSS, JavaScript...\r\nCuốn sách này không những giúp bạn tiết kiệm được thời gian học tập mà còn thích hợp với những ai muốn tò mò tạo một Website, vì sách cung cấp nhiều gợi ý, hướng dẫn rõ ràng trong việc chuẩn bị xuất bản những trang Web đầu tiên ngay sau khi bạn đọc qua vài chương.', 79000, 'th15.jpg', 'gd', 'th', 198, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th16', 'Tuyển Tập Thủ Thuật Javascript - Tập 1', '\"Tuyển Tập Thủ Thuật Javascript\" gồm 2 tập, là một tuyển tập các giải pháp cho những vấn đề phổ biến nhất trong JavaScript. Nó chứa đựng các thủ thuật, gợi ý và kỹ thuật tương thích chuẩn, đã được thử nghiệm và bạn có thể tùy biến để sử dụng trong các trình duyệt khác nhau.', 66000, 'th16.jpg', 'gd', 'th', 5499, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th17', 'Thiết Kế Web Với CSS', '\r\nTừ khi được giới thiệu năm 1996, bảng kiểu xếp tầng (CSS) đã làm thay đổi đáng kể thiết kế Web. Hiện nay, phần lớn trang Web đều sử dụng CSS và nhiều nhà thiết kế đã xây dựng các bố cục trang hoàn toàn dựa trên CSS. Để thực hiện điều này một cách thành công, đòi hỏi chúng ta phải hiểu biết kỹ về nội dung hoạt động của CSS. Sách Thiết Kế Web Với CSS cung cấp cho bạn những vấn đề cần thiết để sử dụng CSS. ', 82000, 'th17.jpg', 'gd', 'th', 6803, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th18', 'Thiết Kế Web Với JavaScript Và Dom', 'Nội dung cuốn sách \"Thiết Kế Web Với JavaScript Và Dom\" giới thiệu về ngôn ngữ lập trình, nhưng nó không chỉ dành riêng cho các lập trình viên, mà còn rất có ích cho các nhà thiết kế Web.', 79000, 'th18.jpg', 'gd', 'th', 7418, '2021-02-27 17:30:44', NULL, NULL, NULL),
('th88', 'sach giao khoa lop 10', '?', 30000, 'th18.jpg', 'gd', 'gk', 6583, '2021-02-27 17:30:44', NULL, NULL, NULL),
('thcs', 'Trung Hoc Co SO', '<p>&lt;tbody&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Mã hàng&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;9786040189066 &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Tên Nhà Cung Cấp&lt;/th&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Nhà xuất bản Giáo Dục &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;/td&gt;<br>&nbsp; &nbsp;&lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Tác giả&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bộ Giáo Dục Và Đào Tạo &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;NXB&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;NXB Giáo Dục Việt Nam &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Năm XB&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;2020 &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Trọng lượng (gr)&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;140 &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Kích Thước Bao Bì&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;24 x 17 cm &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Số trang&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;136 &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp;&lt;th class=\"table-label\"&gt;Hình thức&lt;/th&gt;<br>&nbsp; &nbsp;&lt;td class=\"data\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;Bìa Mềm &nbsp; &nbsp;&lt;/td&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;tr&gt;<br>&nbsp; &nbsp; &nbsp; &lt;th style=\"vertical-align: middle;\" class=\"table-label\"&gt;Sản phẩm hiển thị trong&lt;/th&gt;<br>&nbsp; &nbsp; &nbsp; &lt;td&gt;<br>&nbsp; &nbsp;&lt;ul class=\"fhs_product_link\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;a style=\"font-size: 14px; color: #F39801\" href=\"ong-trum-truong-hoc?fhs_campaign=INTERNAL_LINKING\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; Ông Trùm Trường Học&lt;/a&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;/li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;a style=\"font-size: 14px; color: #F39801\" href=\"sach-giao-khoa?fhs_campaign=INTERNAL_LINKING\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; Sách Giáo Khoa - &nbsp;Tham Khảo Các Cấp&lt;/a&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;/li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;a style=\"font-size: 14px; color: #F39801\" href=\"sach-giao-khoa-cap-3?fhs_campaign=INTERNAL_LINKING\"&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; Sách Giáo Khoa Cấp 3&lt;/a&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;/li&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;/ul&gt;<br>&nbsp; &nbsp; &nbsp; &lt;/td&gt;<br>&nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &lt;tr&gt;<br>&nbsp; &nbsp; &nbsp; &lt;th style=\"vertical-align: middle;\" class=\"table-label\"&gt;Sản phẩm bán chạy nhất&lt;/th&gt;<br>&nbsp; &nbsp; &nbsp; &lt;td&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;a style=\"font-size: 14px; color: #F39801;\" href=\"https://www.fahasa.com/sach-trong-nuoc/giao-khoa-tham-khao/sach-giao-khoa/giao-khoa-lop-12/sach-bai-hoc-lop-12/sort-by/num_orders_month/sort-direction/asc.html\"&gt;Top 100 sản phẩm Sách Giáo Khoa bán chạy của tháng&lt;/a&gt;</p><p>&nbsp; &nbsp; &nbsp; &lt;/td&gt;<br>&nbsp; &lt;/tr&gt;<br>&nbsp; &nbsp; &nbsp; &nbsp;&lt;/tbody&gt;</p>', 100000, 'thcs_Trung Hoc Co SO.jpg', 'gd', 'gk', 0, '2021-03-20 21:57:10', NULL, '2021-03-20 21:57:10', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_thumbnail`
--

CREATE TABLE `book_thumbnail` (
  `book_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail_1` varchar(255) DEFAULT NULL,
  `thumbnail_2` varchar(255) DEFAULT NULL,
  `thumbnail_3` varchar(255) DEFAULT NULL,
  `thumbnail_4` varchar(255) DEFAULT NULL,
  `thumbnail_5` varchar(255) DEFAULT NULL,
  `thumbnail_6` varchar(255) DEFAULT NULL,
  `thumbnail_7` varchar(255) DEFAULT NULL,
  `thumbnail_8` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `book_thumbnail`
--

INSERT INTO `book_thumbnail` (`book_id`, `thumbnail_1`, `thumbnail_2`, `thumbnail_3`, `thumbnail_4`, `thumbnail_5`, `thumbnail_6`, `thumbnail_7`, `thumbnail_8`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
('td01', 'td01_thumb_1.jpg', 'td01_thumb_2.jpg', 'td01_thumb_3.jpg', 'td01_thumb_4.jpg', 'td01_thumb_5.jpg', 'td01_thumb_6.jpg', 'td01_thumb_7.jpg', 'td01_thumb_8.jpg', '2021-02-27 17:30:23', NULL, '2021-03-20 22:44:23', NULL),
('td02', 'td02_thumb_1.jpg', 'td02_thumb_2.jpg', 'td02_thumb_3.jpg', 'td02_thumb_4.jpg', 'td02_thumb_5.jpg', 'td02_thumb_6.jpg', 'td02_thumb_7.jpg', 'td02_thumb_8.jpg', '2021-02-27 17:30:23', NULL, '2021-03-20 22:45:30', NULL),
('td03', 'td03_thumb_1.jpg', 'td03_thumb_2.jpg', 'td03_thumb_3.jpg', 'td03_thumb_4.jpg', 'td03_thumb_5.jpg', 'td03_thumb_6.jpg', 'td03_thumb_7.jpg', 'td03_thumb_8.jpg', '2021-02-27 17:30:23', NULL, '2021-03-20 22:46:01', NULL),
('td05', 'td05_thumb_1.jpg', 'td05_thumb_2.jpg', 'td05_thumb_3.jpg', 'td05_thumb_4.jpg', 'td05_thumb_5.jpg', 'td05_thumb_6.jpg', 'td05_thumb_7.jpg', 'td05_thumb_8.jpg', '2021-02-27 17:30:23', NULL, '2021-03-20 22:53:08', NULL),
('td06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('th88', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2021-02-27 17:30:23', NULL, NULL, NULL),
('thcs', 'thcs_thumb_1.jpg', 'thcs_thumb_2.jpg', 'thcs_thumb_3.jpg', 'thcs_thumb_4.jpg', 'thcs_thumb_5.jpg', 'thcs_thumb_6.jpg', 'thcs_thumb_7.jpg', 'thcs_thumb_8.jpg', '2021-03-20 21:57:10', NULL, '2021-03-20 21:57:10', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cat_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT 'admin',
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `total`, `description`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
('gk', 'Giáo Khoa', 39, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('khkt', 'Ky Thuat', 37, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('kt', 'Kinh Tế', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('Ls', 'Lịch sử ', 38, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('nn', 'Ngoại Ngữ', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('pl', 'Pháp Luật', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('td', 'Từ Điển', 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('test', 'Loai Moi', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('th', 'Tin Học', 18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('tt', 'The Thao Du Lich', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('vh', 'Văn Học', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('vhxh', 'Van Hoa xa Hoi', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fileuploads`
--

CREATE TABLE `fileuploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `votes` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `guest`
--

INSERT INTO `guest` (`id`, `name`, `street`, `district`, `city`, `phone`, `votes`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
(40, 'loc', '29 218 Cao Lỗ, phường 4', 'quận 8', 'Hồ Chí Minh', '+84 374407507', NULL, '2021-03-17 11:35:31', NULL, '2021-03-19 16:57:05', NULL),
(58, '1', '1', '1', '1', '1', '1', '2021-03-06 15:11:03', NULL, NULL, NULL),
(60, '1', '1', '1', '1', '1', '1', '2021-03-06 15:15:15', NULL, NULL, NULL),
(61, '1', '1', '1', '1', '1', '1', '2021-03-06 15:15:47', NULL, NULL, NULL),
(63, '1', '1', '1', '1', '1', '1', '2021-03-06 15:16:08', NULL, NULL, NULL),
(65, '1', '1', '1', '1', '', '1', '2021-03-06 15:45:18', NULL, NULL, NULL),
(67, '1', '1', '1', '', '1', '1', '2021-03-06 15:46:29', NULL, NULL, NULL),
(68, '1', '1', '1', '1', '1', '1', '2021-03-06 15:56:10', NULL, NULL, NULL),
(69, '1', '1', '1', '1', '1', '1', '2021-03-17 10:13:41', NULL, NULL, NULL),
(70, '', '', '', '', '', NULL, '2021-03-19 11:30:01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(5, '2021_02_04_175623_create_cache_table', 2),
(6, '2021_03_09_172818_create_comments_table', 3),
(7, '2021_03_09_173058_create_posts_table', 3),
(8, '2021_03_09_173231_create_password_resets_table', 3),
(9, '2021_03_09_180504_failed_jobs', 4),
(10, '2021_03_12_212557_create_users_table', 5),
(11, '2021_03_13_083104_sinhvien', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT 'tiêu đề',
  `img` varchar(50) DEFAULT NULL COMMENT 'path file hình',
  `short_content` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Nội dung ngắn',
  `content` text CHARACTER SET utf8 NOT NULL COMMENT 'Nội dung',
  `hot` int(1) NOT NULL DEFAULT 0 COMMENT 'tin hot=1, thường: != 1',
  `created` datetime DEFAULT NULL,
  `modiffed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `img`, `short_content`, `content`, `hot`, `created`, `modiffed`) VALUES
(1, 'qqq', 'q', 'q', 'q', 0, NULL, NULL),
(2, 'ww', 'w', 'w', 'w', 1, NULL, NULL),
(3, 'ee', 'e', 'e', 'e', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `notifiable_type` varchar(255) DEFAULT NULL,
  `notifiable_id` int(11) NOT NULL,
  `data` text DEFAULT NULL,
  `read_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('048ec52c-6b46-4051-8788-bc1b99090c04', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":53,\"data\":\"Userloc1@121 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:00:52', '2021-03-06 08:02:56'),
('06d41a4a-1240-4cde-ac8c-dbffa6a48449', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":60,\"data\":\"Userlclc has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:15:15', '2021-03-06 08:46:41'),
('07dc19ca-6d95-4a3d-9ab1-a43ff79d7ab7', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:35', '2021-03-05 13:55:48'),
('0bcf7840-0324-4e12-8c15-a07025878b4d', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:33', '2021-03-05 13:55:48'),
('106df608-c654-4ab4-b70c-b35e112f1df3', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:30', '2021-03-05 13:55:48'),
('138ca01f-cc04-46b2-901b-2e69ee84eec6', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":70,\"data\":\"User :loc1@1 has been created !\"}', NULL, '2021-03-19 04:30:01', '2021-03-19 04:30:01'),
('168297f0-30a2-49f4-830b-2780ced440ca', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 13:04:13', '2021-03-09 14:26:50'),
('1c66685e-852a-4c64-ac40-fffb74e740f1', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 12:53:48', '2021-03-09 14:26:50'),
('1d89628f-7d9c-45ca-af7a-de60dc4a4a48', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"Userlocdo255@gmail.com has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:14:59', '2021-03-06 08:46:41'),
('2445c504-19b2-4651-8a88-5be21d7189eb', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":46,\"data\":\"Userloc1@3 has been created !\"}', '2021-03-06 14:42:58', '2021-03-06 07:42:01', '2021-03-06 07:42:58'),
('29c98018-992a-4188-98e6-bcd527918f58', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:34', '2021-03-05 13:55:48'),
('29dddd93-e151-48f7-a2a8-6c9f3c542d37', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":43,\"data\":\"Userloc1@2 has been created !\"}', '2021-03-06 14:42:58', '2021-03-06 07:41:13', '2021-03-06 07:42:58'),
('2a0a0b4b-a8bf-4215-aaa6-24e2bf355ce8', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":53,\"data\":\"Userloc1@121 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:00:52', '2021-03-06 08:02:56'),
('2f6659d5-4440-403c-abfd-a3419ce2bc25', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:41', '2021-03-05 13:55:48'),
('32e9c404-4420-40f8-bd08-d663968ed9ac', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:35', '2021-03-05 13:55:48'),
('351992c8-6873-4894-8923-82ae92a4ff24', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":70,\"data\":\"User :loc1@1 has been created !\"}', NULL, '2021-03-19 04:30:01', '2021-03-19 04:30:01'),
('354b103f-438d-4780-b69c-a511cf8a9880', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":56,\"data\":\"Userloc1@2 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:04:35', '2021-03-06 08:46:41'),
('38c7679f-918e-4684-be1c-a0f6e2935ece', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', NULL, '2021-03-15 13:30:03', '2021-03-15 13:30:03'),
('3b449865-d563-4b84-be93-46f87e44f39c', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:06:20', '2021-03-05 13:57:06', '2021-03-06 07:06:20'),
('3e34cbed-cbd7-418c-99eb-02f12dba8935', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":46,\"data\":\"Userloc1@3 has been created !\"}', '2021-03-06 14:42:58', '2021-03-06 07:42:01', '2021-03-06 07:42:58'),
('45ca775b-1d5a-496a-8e48-61ddf981a1fe', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-14 22:07:07', '2021-03-09 14:34:38', '2021-03-14 15:07:07'),
('4be2a4ca-1c90-44a0-811c-b69bd66ac545', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":54,\"data\":\"Userloc1@121 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:02:29', '2021-03-06 08:02:56'),
('4edf0981-dd4c-4f2f-a4b5-3640dd0b77b3', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":67,\"data\":\"Userth1 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:46:29', '2021-03-06 08:46:41'),
('517ae8a4-7fe4-4a8b-8a24-56329f621bf5', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"Userlocdo255@gmail.com has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:11:03', '2021-03-06 08:46:41'),
('52041ed2-97a0-414c-9a67-671eb8697186', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 12:50:42', '2021-03-09 14:26:50'),
('52ec6518-9253-4273-a946-7edc61e4453f', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:32', '2021-03-05 13:55:48'),
('599e75c7-71e4-4ecf-8a56-9cd23e6d7b50', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":54,\"data\":\"Userloc1@121 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:02:29', '2021-03-06 08:02:56'),
('5e943085-7428-4d81-8f1f-93e1a089c0ec', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:31', '2021-03-05 13:55:48'),
('5f09b339-6e8b-4997-9f35-0df11cb81bdc', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:36', '2021-03-05 13:55:48'),
('60799d1e-b323-4c3e-baef-b05935f1dc13', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":50,\"data\":\"Userloc1@12 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:00:15', '2021-03-06 08:02:56'),
('62970d91-0fc3-44ab-9d2b-ed7003295df6', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":68,\"data\":\"User :th1@2 has been created !\"}', '2021-03-06 16:41:48', '2021-03-06 08:56:10', '2021-03-06 09:41:48'),
('640e48e7-04ed-4504-afef-cdaa50a9abfd', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 11:16:12', '2021-03-09 14:26:50'),
('72b26d95-2b8f-43a3-aa24-e152b0a77763', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 14:26:44', '2021-03-09 14:26:50'),
('77a6da4f-78ed-4079-989b-05ba403519bf', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":63,\"data\":\"Userloc1@1123 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:16:08', '2021-03-06 08:46:41'),
('7a4ce97a-eda6-4e1c-b914-4afc4024d4f0', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 12:49:27', '2021-03-09 14:26:50'),
('81e9aa49-d375-48bc-bfc3-e2a269b08d82', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 11:15:37', '2021-03-09 14:26:50'),
('8d4984d1-eae6-4547-b04c-b7444b228772', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 11:15:32', '2021-03-09 14:26:50'),
('9079fb71-e36f-4aff-b621-cf034fedeef1', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":69,\"data\":\"User :loc2@2 has been created !\"}', NULL, '2021-03-17 03:13:42', '2021-03-17 03:13:42'),
('91c3d9ae-5b87-47c1-b76d-96d8065df909', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":60,\"data\":\"Userlclc has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:15:15', '2021-03-06 08:46:41'),
('92d5aae4-eb57-4f56-9c98-df4a409232c2', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:39', '2021-03-05 13:55:48'),
('94592556-3252-4b6a-b359-b191b576e4a7', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":65,\"data\":\"Userth has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:45:18', '2021-03-06 08:46:41'),
('a5bbd022-7938-4561-9436-ef6003a2531f', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', NULL, '2021-03-15 13:29:48', '2021-03-15 13:29:48'),
('a7fb7d4c-52be-4796-9a47-a1f95f5cf985', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:29', '2021-03-05 13:55:48'),
('a86ff398-f323-4e2f-86fb-c6afdd36c963', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:37', '2021-03-05 13:55:48'),
('ac98ff1d-5950-42d9-8536-2aecc0ff5d4c', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:30:22', '2021-03-06 07:29:16', '2021-03-06 07:30:22'),
('aee52f60-c9e7-4c6b-8a78-5ce7a9e26aae', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:44', '2021-03-05 13:55:48'),
('b208b36e-b19d-4447-ad0f-6ef23446d6b7', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":61,\"data\":\"Userlocdo2551@gmail.co1 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:15:47', '2021-03-06 08:46:41'),
('b5609c93-f2c3-4940-8e46-5af26c127c33', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 13:25:22', '2021-03-09 14:26:50'),
('bfeaf6c1-bcdf-422e-b840-e227aeadb9ed', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"Userlocdo255@gmail.com has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:11:03', '2021-03-06 08:46:41'),
('c0be0d2f-7a9f-41cd-a78b-f4483578ab24', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:33', '2021-03-05 13:55:48'),
('c5e07733-e12e-4bf1-9ddf-254b26377388', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":67,\"data\":\"Userth1 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:46:29', '2021-03-06 08:46:41'),
('c62d0075-dc00-4a6f-bb65-9503db6ba0c0', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-14 22:07:07', '2021-03-09 14:34:14', '2021-03-14 15:07:07'),
('c67db591-95b7-457b-b66c-fbc601fd9572', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":69,\"data\":\"User :loc2@2 has been created !\"}', NULL, '2021-03-17 03:13:42', '2021-03-17 03:13:42'),
('c7af0e97-09cc-4522-9a39-a70e04258df0', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:44:35', '2021-03-05 13:55:48'),
('c93ddc4d-f753-4e01-b744-ce420f7aff2e', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":64,\"data\":\"Userlc has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:38:19', '2021-03-06 08:46:41'),
('ca2db927-277e-4d00-8b71-feeb8ca66a1b', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:31:12', '2021-03-06 07:31:08', '2021-03-06 07:31:12'),
('cc2b1051-0db8-4238-adde-04ef3688fab2', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-14 22:07:07', '2021-03-09 14:26:53', '2021-03-14 15:07:07'),
('d0c49275-1d96-4153-85ec-c388c4245983', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 13:55:42', '2021-03-05 13:55:48'),
('d433a9c1-a5dd-4bea-8d8d-bc20f55adf1e', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:32:16', '2021-03-06 07:32:12', '2021-03-06 07:32:16'),
('d553eb60-e8c4-4c42-905b-a2e10aa6ef86', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:33:24', '2021-03-06 07:33:21', '2021-03-06 07:33:24'),
('e0c384c8-2d01-4e6f-a362-1893a3f726c0', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-14 22:07:07', '2021-03-09 14:34:09', '2021-03-14 15:07:07'),
('e14d0173-2c07-42f0-9de2-cf9f5de72740', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":68,\"data\":\"User :th1@2 has been created !\"}', '2021-03-06 16:41:48', '2021-03-06 08:56:10', '2021-03-06 09:41:48'),
('e9334d3a-bcda-4e4d-a09f-95549b02cd65', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', NULL, '2021-03-17 03:13:00', '2021-03-17 03:13:00'),
('edc9cf58-152c-4a1a-8c96-8750229552e6', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":50,\"data\":\"Userloc1@12 has been created !\"}', '2021-03-06 15:02:56', '2021-03-06 08:00:15', '2021-03-06 08:02:56'),
('f26db294-eaf5-4199-a04a-d881fcc3e5d9', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":58,\"data\":\"User :locdo255@gmail.com has been created !\"}', '2021-03-09 21:26:50', '2021-03-09 11:16:16', '2021-03-09 14:26:50'),
('f8ea035b-a613-433f-b971-275b072350d7', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-06 14:32:08', '2021-03-06 07:32:06', '2021-03-06 07:32:08'),
('fc851f60-fe89-4b2b-a086-2142658e472d', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":56,\"data\":\"Userloc1@2 has been created !\"}', '2021-03-06 15:46:41', '2021-03-06 08:04:35', '2021-03-06 08:46:41'),
('fece48b2-f13c-45a6-aa62-39a2266f562d', 'App\\Notifications\\UserRegistedNotification', 'App\\Models\\UserModel', 40, '{\"thread\":42,\"data\":\"Userloc2 has been created !\"}', '2021-03-05 20:55:48', '2021-03-05 09:50:36', '2021-03-05 13:55:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(10) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_shiping` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(10) NOT NULL,
  `book_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` double UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publisher`
--

CREATE TABLE `publisher` (
  `pub_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pub_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pub_img` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `publisher`
--

INSERT INTO `publisher` (`pub_id`, `pub_name`, `pub_img`, `total`, `description`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
('gd', 'Giáo dục 1', 'gd_Giáo dục 1.jpg', 18, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('hcm', 'Tổng Hợp Hồ Chí Minh', 'hcm_Tổng Hợp Hồ Chí Minh.jpg', 10, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('hnv', 'Hội Nhà Văn', 'hnv_Hội Nhà Văn.jpg', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('kd', 'Nhà Xuất Bản Kim Đồng 1', 'annelies-geneyn-bhBONc07WsI-unsplash.jpg', NULL, '<p>Nhà Xuất Bản Kim Đồng</p>', '2021-03-20 22:03:28', NULL, NULL, NULL),
('pn', 'Phụ Nữ', 'pn_Phụ Nữ.jpg', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('tn', 'Thanh Niên', 'tn_Thanh Niên.jpg', 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('vh', 'Văn Học', 'vh_Văn Học.jpg', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL),
('vhtt', 'Văn Hóa Thông Tin', 'vhtt_Văn Hóa Thông Tin.jpg', 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>', '2021-02-27 17:29:45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Chuc nang admin'),
(2, 'user', 'Nguoi dung ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `user_agent` text CHARACTER SET armscii8 DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c7Ifx2eXOrrhXngupCR1Nr5M3TwjAh6IV3FhlOX5', 40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieGtoaDZ5dzNYSkVFVFJmaHVWUmFMekJPSmZGZkdwdDFEd3FZZTRhQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvd2ViYm9va3N0b3JlL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntzOjc6ImRlZmF1bHQiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoxOntzOjg6IgAqAGl0ZW1zIjthOjI6e3M6MzI6IjBjNjYxNzI4MjIxZWZmZTI4MTE5MTE1ZTYzMmY1OTg0IjtPOjMyOiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbSI6MTA6e3M6NToicm93SWQiO3M6MzI6IjBjNjYxNzI4MjIxZWZmZTI4MTE5MTE1ZTYzMmY1OTg0IjtzOjI6ImlkIjtzOjQ6InRkMDEiO3M6MzoicXR5IjtpOjM7czo0OiJuYW1lIjtzOjM4OiJU4burIMSQaeG7g24gbeG6q3UgY8OidSB0aeG6v25nIE5o4bqtdCI7czo1OiJwcmljZSI7ZDo0NTAwMDA7czo2OiJ3ZWlnaHQiO2Q6MjU7czo3OiJvcHRpb25zIjtPOjM5OiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjE6e3M6ODoiACoAaXRlbXMiO2E6MTp7czo1OiJpbWFnZSI7czo4OiJ0ZDAxLmpwZyI7fX1zOjc6InRheFJhdGUiO2k6MjE7czo0OToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGFzc29jaWF0ZWRNb2RlbCI7TjtzOjQ2OiIAR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AZGlzY291bnRSYXRlIjtpOjA7fXM6MzI6IjliZDRkNGZiYjhmNjk2NjA5MGQ2OTQ0ZGNhMjFkMjZmIjtPOjMyOiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbSI6MTA6e3M6NToicm93SWQiO3M6MzI6IjliZDRkNGZiYjhmNjk2NjA5MGQ2OTQ0ZGNhMjFkMjZmIjtzOjI6ImlkIjtzOjQ6InRkMDMiO3M6MzoicXR5IjtpOjE7czo0OiJuYW1lIjtzOjUzOiLEkOG6oWkgVOG7qyDEkGnhu4NuIFRp4bq/bmcgVmnhu4d0IChC4bqjbiBt4bubaSAyMDEwKSI7czo1OiJwcmljZSI7ZDo0NTAwMDA7czo2OiJ3ZWlnaHQiO2Q6MjU7czo3OiJvcHRpb25zIjtPOjM5OiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjE6e3M6ODoiACoAaXRlbXMiO2E6MTp7czo1OiJpbWFnZSI7czo4OiJ0ZDAzLmpwZyI7fX1zOjc6InRheFJhdGUiO2k6MjE7czo0OToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGFzc29jaWF0ZWRNb2RlbCI7TjtzOjQ2OiIAR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AZGlzY291bnRSYXRlIjtpOjA7fX19fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQwO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkU3lJeXoxZWVXRHlsL1JaSlVSZHpvT0hPVkxONlY1cFpOR0k2Q2RmeTZiTG0wQVpOenB1UnUiO30=', 1616267477);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `thumb` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modiffed` datetime DEFAULT NULL,
  `modiffed_by` varchar(255) DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`id`, `name`, `description`, `link`, `thumb`, `created`, `created_by`, `modiffed`, `modiffed_by`, `status`) VALUES
(1, 'bg-image--1', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide1.jpg', '2020-11-29 16:38:53', 'admin', '2020-11-29 16:38:37', 'admin', 'active'),
(2, 'bg-image--2', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide2.jpg', '2020-11-29 16:45:41', 'admin', '2020-11-29 16:45:36', 'admin', 'active'),
(3, 'bg-image--3', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide3.jpg', '2020-11-29 16:44:54', 'admin', '2020-11-29 16:45:03', 'admin', 'active'),
(4, 'bg-image--4', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide4.jpg', '2020-11-29 16:46:55', 'admin', '2020-11-29 16:46:59', 'admin', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`id`, `name`, `description`) VALUES
(1, 'active', 'dang hoat dong '),
(2, 'ban', 'bi cam hoat dong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `level` varchar(10) CHARACTER SET utf32 NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_account`
--

INSERT INTO `user_account` (`user_id`, `user_name`, `password`, `remember_token`, `email`, `email_verified_at`, `level`, `status`, `modiffed_at`, `modiffed_by`, `created_at`, `created_by`) VALUES
(40, 'loc1', '$2y$10$SyIyz1eeWDyl/RZJURdzoOHOVLN6V5pZNGI6Cdfy6bLm0AZNzpuRu', '4iPDDXTi0vAtdlph1LZOKy4JPbiGSir0CDf2NHfq5BdqU9lFSFEC7aO0iV6W', 'loc1@1', NULL, 'admin', 'active', NULL, NULL, '2020-12-24 09:43:29', NULL),
(58, 'locdo255@gmail.com', '$2y$10$6mnkSO5aDMdp5eAPbI55uOdE/mFnH1xT8uWOwNMGQM.6Ugt1uzuSa', NULL, 'locdo255@gmail.com', NULL, 'user', 'active', '2021-03-06 15:11:03', NULL, '2021-03-06 15:11:03', 'locdo255@gmail.com');

--
-- Bẫy `user_account`
--
DELIMITER $$
CREATE TRIGGER `insert_userdetail` AFTER INSERT ON `user_account` FOR EACH ROW INSERT INTO user_detail(user_id) VALUES(NEW.user_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_detail`
--

CREATE TABLE `user_detail` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `list_favorite` varchar(250) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `votes` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffed_at` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_detail`
--

INSERT INTO `user_detail` (`user_id`, `full_name`, `street`, `district`, `city`, `phone`, `list_favorite`, `img`, `votes`, `created_at`, `created_by`, `modiffed_at`, `modiffed_by`) VALUES
(40, 'loc', '29 218 Cao Lỗ, phường 4', 'quận 8', 'Hồ Chí Minh', '+84 374407507', NULL, '1.jpg', NULL, '2021-03-17 11:35:31', NULL, '2021-03-19 16:57:05', NULL),
(58, '1', '1', '1', '1', '1', '1', '1', '1', '2021-03-06 15:11:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `manxb` (`pub_id`,`cat_id`),
  ADD KEY `maloai` (`cat_id`),
  ADD KEY `book_name` (`book_name`);

--
-- Chỉ mục cho bảng `book_thumbnail`
--
ALTER TABLE `book_thumbnail`
  ADD PRIMARY KEY (`book_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cmt_account` (`user_id`),
  ADD KEY `fk_cmt_post` (`post_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `fileuploads`
--
ALTER TABLE `fileuploads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_name` (`id`,`name`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_notification` (`notifiable_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`) USING BTREE,
  ADD KEY `order_id` (`order_id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`book_id`) USING BTREE,
  ADD KEY `masach` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`pub_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Chỉ mục cho bảng `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `user_name` (`user_id`,`full_name`);

--
-- Chỉ mục cho bảng `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `fileuploads`
--
ALTER TABLE `fileuploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `publisher` (`pub_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `book_thumbnail`
--
ALTER TABLE `book_thumbnail`
  ADD CONSTRAINT `fk_book_thumb` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_cmt_account` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`),
  ADD CONSTRAINT `fk_cmt_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_user_notification` FOREIGN KEY (`notifiable_id`) REFERENCES `user_account` (`user_id`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_book_order` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `fk_order_orderdetail` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_account` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`);

--
-- Các ràng buộc cho bảng `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
