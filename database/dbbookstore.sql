-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 06:15 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
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
  `created` datetime DEFAULT NULL,
  `modiffed` datetime DEFAULT NULL,
  `date_released` double(10,0) DEFAULT NULL,
  `totall_sell` double(10,0) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `description`, `price`, `img`, `pub_id`, `cat_id`, `promotion_price`, `created`, `modiffed`, `date_released`, `totall_sell`, `thumb`) VALUES
('1', '2', '3', 11, '90337578_203147617643647_5423932108684918784_n.jpg', 'gd', 'gk', 3217, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 49, 108, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('11', '11', '11', 11, '90337578_203147617643647_5423932108684918784_n.jpg', 'gd', 'gk', 3217, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 49, 108, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('12', '12', '121212', 121212, '81135065_157666762210200_2453505350649774080_n.jpg', 'gd', 'gk', 397, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 44, 100, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td01', 'Từ Điển mẫu câu tiếng Nhật', 'Tập hợp tất cả các mẫu câu tiếng Nhật. Phong phú, đầu đủ nhất. ', 450000, 'td01.jpg', 'gd', 'td', 2235, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 26, 67, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td02', 'Từ Điển Kinh Doanh Và Tiếp Thị Hiện Đại', 'Quyển sách “Từ điển Kinh doanh – Tiếp thị Hiện đại” (Modern Business & Marketing Dictionary) của tác giả Cung Kim Tiến (Bút danh Anh Tuấn) trình bày các thuật ngữ đang sử dụng thịnh hành trong giao dịch kinh doanh và tiếp thị trong nước và quốc tế. Đặc điểm của quyển sách là các thuật ngữ được đặt trong các bối cảnh khác nhau, bằng cách dẫn các đoạn văn xuất hiện trong thực tiễn kinh doanh quốc tế, giúp bạn đọc hiểu rõ được ý nghĩa và cách sử dụng trong thực tiễn của các thuật ngữ chuyên biệt này, với các nội dung thú vị khác nhau.\r\n Tác giả đã chọn lọc một cách công phu các đoạn văn đa dạng và phong phú, xuất hiện trên các ấn phẩm quốc tế khác nhau, giúp độc giả có cơ hội thuận lợi trong giao tiếp, soạn thảo, hoặc tham gia các buổi họp liên quan đến kinh doanh, đảm nhiệm các nhiệm vụ về kinh doanh, quản lý và tiếp thị trong các doanh nghiệp.\r\nQuyển sách này được kỳ vọng sẽ trợ giúp hiệu quả để bạn đọc tiếp cận một lĩnh vực tri thức kinh doanh bằng Anh ngữ, là bạn đồng hành trên con đường sự nghiệp trong thời kỳ quốc tế hóa.', 195000, 'td02.gif', 'vhtt', 'td', 9885, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 47, 25, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td03', 'Đại Từ Điển Tiếng Việt (Bản mới 2010)', 'Thêm yêu tiếng Việt\r\n\r\n \r\n\r\nTừ lâu chúng ta đã có nhiều công trình nghiên cứu về kho tàng tiếng Việt, thế nhưng “Đại từ điển tiếng Việt” (NXB Đại học Quốc gia TPHCM - Nguyễn Như Ý chủ biên) vừa ra mắt bạn đọc là công trình đầy đặn và đồ sộ nhất. Cuốn sách đã bắt nhịp cầu cho những ai yêu tiếng mẹ…\r\n\r\n \r\n\r\nCầm trên tay cuốn Đại từ điển dày gần 2.000 trang mới cảm nhận hết tâm huyết của những người làm sách. Cuốn từ điển này được in lần đầu tiên vào năm 1999, đến nay, đáp ứng nhu cầu của bạn đọc, các tác giả đã tiến hành nghiên cứu, bổ sung.\r\n\r\n \r\n\r\nTrong lần tái bản này, ban biên soạn đã chọn và đưa vào sách những từ ngữ mới xuất hiện và đã được dùng rộng rãi trong đời sống và trên các phương tiện thông tin đại chúng nhằm làm tăng tính mới mẻ và tiện ích cho người sử dụng.\r\n\r\n \r\n\r\nMột trong những ý tưởng chinh phục người đọc là tính đa dạng của Đại từ điển tiếng Việt. Bởi nó không chỉ đơn thuần là sự tra cứu nghĩa các từ mà mở ra chân trời kiến thức mới. Việc đan xen những kiến thức cơ bản về văn hóa, văn minh Việt Nam và thế giới, giới thiệu tổng quan và hệ thống các hiện vật văn hóa như: Đơn vị đo lường của Việt Nam và thế giới, đồng bạc Việt xưa và nay, các loại trống đồng hiện có ở Việt Nam, quốc kỳ các nước trên thế giới… Đây là những thông tin bổ ích đáp ứng nhu cầu bổ sung kiến thức cơ bản của học sinh - sinh viên và các bạn trẻ Việt Nam.\r\n\r\n\r\n', 450000, 'td03.jpg', 'hcm', 'td', 2621, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 10, 15, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td04', 'từ điển y học sức khỏe bệnh lý Anh Anh Việt', 'Từ điển y học - sức khỏe bệnh lý Anh Anh Việt này được biên soạn để đáp ứng nhu cầu tìm hiểu, tra cướu và dịch thuật các tư liệu y khoa bằng tiếng anh, cũng như tăng cường kiến thức về các bệnh thường gặp của các thành phần độc giả trong xã hội. ', 380000, 'td04.jpg', 'tn', 'td', 3350, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 8, 88, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td05', 'Từ Điển Anh Việt - 75000 Từ', 'Từ điển mới ...', 50000, 'td05.jpg', 'hcm', 'td', 8789, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 9, 87, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('td06', 'Từ điển địa danh hành chính Nam Bộ', 'Từ điển địa danh hành chính Nam Bộ do tác giả Nguyễn Đình Tư biên soạn hết sức công phu, tổng hợp được nhiều tư liệu quý, là công cụ giúp bạn đọc tra cứu một cách khoa học về địa danh hành chính. Đây là cuốn sách có giá trị không chỉ bởi nó cung cấp một lượng mục từ khá đồ sộ, mà còn bởi tác giả đã dành rất nhiều công sức và tâm huyết để sưu tầm, xử lý tư liệu về vùng đất có bề dày truyền thống lịch sử, nhưng cũng có sự thay đổi nhiều và phức tạp nhất về địa danh hành chính', 265000, 'td06.jpg', 'hcm', 'td', 3793, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 24, 60, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th01', '100 thủ thuật với Excel 2010', '100 thủ thuật ứng với 100 bài tập thực hành được hướng dẫn, giải thích theo bố cục chặt chẽ, cách trình bày rõ ràng, dễ sử dụng, bạn đọc có thể tự mình xử lý những vấn đề nảy sinh trong quá trình thực hành đồng thời giúp các bạn thao tác nhanh trên bảng tính.\r\n', 54000, 'th01.gif', 'hcm', 'th', 2498, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 44, 32, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th02', 'Lập trình web bằng PHP 5.3 và cơ sở dữ liệu', 'Tiếp theo tập 1, tập 2 của cuốn sách \"Lập trình Web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1\" bao gồm 10 chương và ứng dụng đính kèm lần lượt giới thiệu cùng bạn đọc các kiến thức liên quan đến Session, Cookie, giỏ hàng trực tuyến, tìm kiếm và phân trang dữ liệu, lập trình hướng đối tượng và sử dụng Zend Framework.\r\n\r\nChương 8 trình bày kiến thức cơ bản của kịch bản trình chủ PHP và cơ sở dữ liệu MySQL.\r\n\r\nSang chương 9, bạn tiếp tục tìm hiểu cách thiết kế trang Web cho phép người sử dụng tìm kiếm và phân trang dữ liệu trình bày với nhiều hình thức khác nhau.\r\n\r\nĐể xây dựng ứng dụng thương mại điện tử hoàn chỉnh và mang tính chuyên nghiệp cao, bạn tiếp tục tìm hiểu cách sử dụng hàm Session và Cookie trong chương 10 để lưu trữ thông tin của người sử dụng nhằm vào mục đích quản lý tài nguyên của Website.\r\n\r\nMọi ứng dụng thương mại điện tử đều cung cấp chương giỏ hàng trực tuyến, bạn cũng được tìm hiểu cách xây dựng giỏ hàng bằng cách sử dụng Session lẫn Cookie trong chương 11.\r\n\r\nKhi có nhu cầu trình bày hình ảnh, đồ thị và âm thanh lẫn phim ảnh, bạn tìm hiểu cách sử dụng mã PHP trong chương 12.\r\n\r\nTiếp theo, bạn có thể tìm hiểu cú pháp của kịch bản PHP trong chương 13 và học cách lập trình hướng đối tượng và sử dụng lớp này vào ứng dụng trong chương 14.\r\n\r\nChương 15 giúp bạn sử dụng kịch bản trình khách Java Script để thay đổi góc nhìn và ứng xử của thẻ HTML trong trang Web.\r\n\r\nSang chương 16, bạn khám phá thư viện mã nguồn mở Zend viết bằng PHP dùng cho các loại cơ sở dữ liệu và học cách sử dụng các lớp trong thư viện này vào ứng dụng bán hàng trực tuyến trong chương 17.', 76000, 'th02.jpg', 'hcm', 'th', 1013, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 47, 71, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th03', 'Lập trình web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1 (Tập1)', 'Tập 1 của cuốn sách \"Lập trình Web bằng PHP 5.3 và cơ sở dữ liệu MySQL 5.1\" bao gồm 7 chương và ứng dụng đính kèm. Chương 1 cung cấp cho bạn kiến thức từ chức năng của Website, cài đặt gói WamSever 2.0 và cấu hình để có thể vận hành ứng dụng Web bằng PHP, MySQL và Apache Web Sever.\r\n\r\nSang chương 2, bạn tiếp tục tìm hiểu cách tạo Website và thiết kế cấu trúc dùng cho doanh nghiệp bằng hệ quản trị nội dung mã nguồn mở Joomla. Nhằm thỏa mãn nội dung trình bày, bạn tiếp tục tìm hiểu cách thiết kế trang Web tĩnh hay động bằng mã tự sinh PHP với phần mềm Dreamweaver CS trong chương 3 và thẻ HTML trong chương 4.\r\n\r\nTiếp theo, bạn có thể tìm hiểu cú pháp của kịch bản PHP trong chương 5 và học cách sử dụng ứng dụng PhpMyAdmin để quản trị cơ sở dữ liệu MySQL trong chương 6. Sang chương 7 bạn tìm hiểu phát biểu SQL của cơ sở dữ liệu MySQL dùng để xây dựng ứng dụng bán hàng trực tuyến.', 76000, 'th03.jpg', 'hcm', 'th', 7471, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 5, 48, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th04', 'Làm Quen Với Internet', 'Ngày nay với sự phát triển không ngừng của kinh tế nói chung và ngành công nghệ thông tin nói riêng, chúng ta có thể dễ dàng tiếp xúc và làm quen với máy vi tính. Tuy nhiên đây là một lĩnh vực mới lại chưa được phổ cập ở mọi cấp học nên các em sẽ có cảm giác bỡ ngỡ, thiếu tự tin khi lần đầu làm quen với chiếc máy tính đa năng. Mỗi bài học trong cuốn sách là một bài thực hành, được thực hiện qua từng bước cơ bản với hình ảnh minh họa trực quan và những lời giải thích chi tiết.', 31000, 'th04.jpg', 'hcm', 'th', 4219, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 34, 17, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th05', 'Từng Bước Làm Quen Với Máy Tính', 'Mục Lục:\r\n\r\nBài 1: Máy tính điện tử và hệ điều hành\r\n\r\nBài 2: Hệ điều hành Window XP\r\n\r\nBài 3: Làm việc với máy tính qua desktop\r\n\r\nBài 4: Tệp tin và thư mục\r\n\r\nBài 5: Sử dụng Window Explorer\r\n\r\nBài 6: Một số thao tác cần biết\r\n\r\nPhụ lục – Những tổ hợp phím tắt', 31000, 'th05.jpg', 'vhtt', 'th', 8580, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 7, 31, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th06', 'Quản Trị Windows Server 2008 - Tập 2', 'Kế thừa những ưu điểm vượt trội và sự thành công của Windows Server 2003 cùng những phiên bản Windows trước đó, hãng Microsoft tiếp tục cho ra đời một phiên bản hệ điều hành dành cho máy chủ mới, Windows Server 2008. Phiên bản này đem đến cho người dùng sự nhanh chóng trong cài đặt; sự tiện lợi trong quản trị hệ thống, tương tác với các thành phần và dịch vụ vì được tập trung vài một công cụ duy nhất – Server Manager, những cải tiến đáng chú ý trên Windows Firewall; công nghệ ảo hoá…\r\n\r\nWindows Server 2008 còn cung cấp cho người sử dụng cách thức cài đặt Server Core, bao gồm những thành phần cơ bản nhất của Windows Server và giao diện dòng lệnh. Với kiểu cài đặt này, giao diện đồ hoạ quen thuộc của Windows cùng những dịch vụ không cần thiết sẽ không được cài đặt lên hệ thống. Nhờ đó nâng cao độ bảo mật và nâng cấp hệ thống.', 62000, 'th06.jpg', 'hcm', 'th', 143, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 32, 97, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th07', 'Kỹ Thuật Lập Trình C - Cơ Sở Và Nâng Cao', ' Cuốn sách này gồm những nội dung chính sau:\r\n# Chương 1: Các khái niệm cơ bản\r\n# Chương 2: Hằng biến và mảng\r\n# Chương 3: Biểu thức\r\n# Chương 4: Vào ra\r\n# Chương 5: Các toán tử điều khiển\r\n# Chương 6: Hàm và cấu trúc chương trình\r\n# Chương 7: Cấu trúc\r\n# Chương 8: Quản lý màn hình và cửa sổ\r\n# Chương 9: Đồ họa\r\n# Chương 10: Thao tác trên các tập tin\r\n# Chương 11: Lưu trữ dữ liệu và tổ chức bộ nhớ chương trình\r\n# Chương 12: Các chỉ thị tiền xử lý\r\n# Chương 13: Sử dụng ngắt trong C\r\n# Chương 14: Truy nhập trực tiếp vào bộ nhớ\r\n# Chương 15: Hàm xử ngắt và chương trình thường trú\r\n# Chương 16: Âm thanh, âm nhạc\r\n# Chương 17: Lập trình theo thời gian, theo sự kiện và trò chơi\r\n# Chương 18: Giao diện giữa C và Assembler\r\n# Phụ lục 1: Quy tắc xuống dòng và sử dụng các khoảng trống khi viết chương trình\r\n# Phụ lục 2: Tóm tắt các hàm chuẩn của Turbo C\r\n# Phụ lục 3: Bảng mã ASCII\r\n# Phụ lục 4: Cài đặt Turbo C vào đĩa cứng\r\n# Phụ lục 5: Hướng dẫn sử dụng môi trường kết hợp Turbo C\r\n# Phụ lục 6: Hệ soạn thảo của Turbo C\r\n# Phụ lục 7: Dùng menu project dịch chương trình trên nhiều tệp\r\n# Phụ lục 8: Dịch chương trình theo chế độ dòng lệnh TCC\r\n# Phụ lục 9: Sửa đổi cú pháp và gỡ rối chương trình\r\n# Phụ lục 10: Các mô hình bộ nhớ\r\n# Phụ lục 11: Danh sách các hàm của Turbo C theo thứ tự ABC\r\n# Phụ lục 12: Hàm với đối số bất định trong C\r\n# Phụ lục 13: Một số chương trình hữu ích', 72000, 'th07.jpg', 'tn', 'th', 4875, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 39, 80, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th08', 'Giáo Trình Học Nhanh SQL Server 2008 - Tập 2', 'Bộ sách “Giáo trình học nhanh SQL Server 2008” được biên soạn dành cho các nhà phát triển và các nhà quản trị cơ sở dữ liệu, những người đang công tác trong lĩnh vực quản lý dữ liệu doanh nghiệp và cho tất cả những ai quan tâm đến SQL Server 2008.\r\n\r\n\r\nVới cách thiết kế và bố cục rõ ràng theo từng chủ điểm cụ thể, bộ sách tập trung trình bày những tính năng chính của SQL Server 2008 nhằm mục đích giúp bạn đọc tăng cường kiến thức đồng thời nâng cao kỹ năng sử dụng sản phẩm mới rất tuyệt vời này. Bộ sách được chia thành 2 tập với bốn phần chính sau đây:', 81000, 'th08.jpg', 'hcm', 'th', 3848, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 0, 101, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th09', '160 Vấn Đề Cần Nên Biết Khi Sử Dụng Đồ Họa Máy Vi Tính', '\"160 Vấn Đề Cần Nên Biết Khi Sử Dụng Đồ Họa Máy Vi Tính\" bao gồm những vấn đề cơ bản và thiết yếu mà những người đang học hay làm đồ họa máy vi tính thường quan tâm tìm hiểu nhằm làm việc hiệu quả hơn với các chương trình phần mềm như Photoshop, CorelDRAW và Illustrator.\r\n\r\n\r\nSách gồm 3 phần, được thiết kế và bố cục theo từng vấn đề cụ thể từ cơ bản đến chuyên nghiệp như tùy biến Photoshop cho các dự án mà bạn thực hiện, chỉnh sửa các bức ảnh chân dung, tạo nên điều kỳ diệu với những hiệu ứng số đặc biệt, trình bày hình ảnh một cách chuyên nghiệp, tạo các thiết kế và viết lời truyện tranh trong CorelDRAW, và áp dụng các hiệu ứng với Illustrator.\r\n\r\n\r\nSách được trình bày ngắn gọn, rõ ràng kèm hình ảnh minh họa. Ngoài ra sách còn bao gồm nhiều thủ thuật và lưu ý hữu ích.', 85000, 'th09.jpg', 'tn', 'th', 4517, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 33, 56, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th10', 'Giáo Trình Học Nhanh SQL Server 2008 - Tập 1', 'Bộ sách “Giáo trình học nhanh SQL Server 2008” được biên soạn dành cho các nhà phát triển và các nhà quản trị cơ sở dữ liệu, những người đang công tác trong lĩnh vực quản lý dữ liệu doanh nghiệp và cho tất cả những ai quan tâm đến SQL Server 2008.\r\n\r\n\r\nVới cách thiết kế và bố cục rõ ràng theo từng chủ điểm cụ thể, bộ sách tập trung trình bày những tính năng chính của SQL Server 2008 nhằm mục đích giúp bạn đọc tăng cường kiến thức đồng thời nâng cao kỹ năng sử dụng sản phẩm mới rất tuyệt vời này.', 69000, 'th10.jpg', 'tn', 'th', 941, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 16, 66, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th11', 'Microsoft Word 2007 - Căn Bản Và Thủ Thuật', 'Microsoft Word 2007 nói riêng và Microsoft Office 2007 nói chung có nhiều đổi mới. Microsoft chẳng những cung cấp cho người dùng giao diện đẹp mắt mà còn có nhiều tiện ích và trực quan hơn so với các phiên bản trước đây. Thay cho thanh menu và các thanh dụng cụ là một hệ thống Ribbon bao gồm các thẻ, các nhóm, trong từng menu lại có các menu phụ và các lệnh. Khi bạn trỏ chuột vào biểu tượng nào của hệ thống này sẽ hiển thị ScreenTip cho biết chức năng và công dụng của chúng. Chẳng những thế, Word còn thể hiện tức thời hiệu quả của từng lệnh để bạn xem, trước khi chọn chúng.\r\n\r\n\r\nTrong quyển sách này, chúng tôi trình bày tóm tắt lý thuyết căn bản về soạn thảo, chỉnh sửa, định dạng văn bản và một số thủ thuật mà bất cứ ai làm công tác văn phòng đều phải sử dụng. Nội dung sách gồm 6 bài: 1-Thủ thuật tổng quát, 2-Soạn thảo và chỉnh sửa văn bản, 3-Định dạng văn bản, 4-WordArt và xử lý hình ảnh, 5-Liên kết và Web, 6-Bảo mật & in ấn văn bản,. Từ bài 2 đến bài 4, trước khi trình bày thủ thuật, chúng tôi tóm tắt lý thuyết giống như giáo trình Word 2007 để bạn thực hành', 69000, 'th11.jpg', 'gd', 'th', 1053, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 32, 52, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th12', 'Kế Toán Doanh Nghiệp Với ACCESS', 'Sách mới...', 76000, 'th12.jpg', 'gd', 'th', 2342, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 11, 52, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th13', 'Giáo Trình C++ & Lập Trình Hướng Đối Tượng', 'Cuốn sách gồm 12 chương và 7 phụ lục:\r\n\r\nChương 1 hướng dẫn cách làm việc với phần mềm TC++ 3.0 để thử nghiệm các chương trình, trình bày sơ lược về các phương pháp lập trình và giới thiệu một số mở rộng đơn giản của C.\r\n\r\nChương 2 trình bày các khả năng mới trong việc xây dựng và sử dụng hàm trong C++ như biến tham chiếu, đối có kiểu tham chiếu, đối có giá trị mặc định, hàm trực tuyến, hàm trùng tên, hàm toán tử.\r\n\r\nChương 3 nói về một khái niệm trung tâm của lập trình hướng đối tượng là lớp gồm: Định nghĩa lớp, khai báo các biến, mảng đối tượng ( kiểu lớp ), phương pháp, dùng con trỏ this trong phương thức, phạm vi truy xuất của các thành phần, các phương thức toán tử.\r\n\r\nChương 4 trình bày các vấn đề tạo dựng, sao chép, huỷ bỏ các đối tượng và các vấn đề khác có liên quan như: Hàm tạo, hàm tạo sao chép, hàm huỷ, toán tử gán, cấp phát bộ nhớ cho đối tượng, hàm bạn, lớp bạn.\r\n\r\nChương 5 trình bày một khái niệm quan trong tạo nên khả năng mạnh của lập trình hướng đối tượng trong việc phát triển, mở rộng phầm mềm, đó là khả năng thừa kế củaw các lớp.\r\n\r\nChương 6 trình bày một khái niệm quan trọng khác cho phép xử lý các vấn đề khác nhau, các thực thể khác nhau, các thuật toán khác nhau theo cùng một lược đồ thống nhất, đó là tính tướng ứng bội và phương thức ảo. Các công cụ này cho phép dễ dàng tổ chức chương trình quản lý nhiều dạng đối tượng khác nhau.\r\n\r\nChương 7 trình bày các thao tác trên tệp như: tạo một tệp mới, ghi dữ liệu từ bộ nhớ lên tệp, đọc dữ liệu từ tệp vào bộ nhớ...\r\n\r\nChương 8 nói về việc tổ chức vào/ ra trong C++.C++ đưa vào một khái niệm mới gọi là các dòng tin ( Stream ), Các thao tác vào/ra sẽ thực hiện trao đổi dữ liệu giữa các bộ nhớ với dòng tin: Vào là chuyển dữ liệu từ dòng nhập vào bộ nhớ, ra là chuyển dữ liệu từ bộ nhớ lên dòng xuất. Để nhập xuất dữ liệu trên một thiết bị cụ thể nào, ta chỉ cần gắn dòng nhập xuất với thiết bị đó. Việc tổ chức vào ra theo cách như vậy là rất khoa học và tiện lợi vì nó có tính độc lập thiết bị.\r\n\r\nChương 9 trình bày các hàm đồ hoạ sử dụng trong C và C++. Các hàm này được sử dụng rải rác trong toàn bộ cuốn sách để xây dựng các đối tượng đồ hoạ.\r\n\r\nChương 10 trình bày các hàm truy xuất trực tiếp vào bộ nhớ của máy tính, trong đó có bộ nhớ màn hình. Các hàm này sẽ được sử dụng trong chương 11 để xây dựng các lớp menu và cửa sổ.\r\n\r\nChương 11 giới thiệu 5 chương trình tương đối hoàn chỉnh nhằm minh hoạ thêm khả năng và kỹ thuật lập trình hướng đối tượng trên C++.\r\n\r\nChương 12 trình bày thêm một số chương trình đối tượng trên C++. Đây là các chương trình tương đối phức tạp, hữu ích và sử dụng các công cụ mạnh của C++.', 78000, 'th13.gif', 'gd', 'th', 8451, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 12, 95, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th14', 'Các Thủ Thuật Trong HTML Và Thiết Kế Web', 'Cuốn sách này sẽ cung cấp các thông tin cần thiết để đẩy nhanh tốc độ thiết kế Web thông qua việc thực hành với các mẫu của nhiều chuyên gia thiết kế Web.\r\nCuốn sách tập trung vào các chi tiết để tạo ra các Web site tốt thông qua nhiều cách tiếp cận hiện đại để giải quyết các thách thức liên quan đến việc tạo Web site. Thay vì đi vào từng ngôn ngữ và công nghệ cụ thể, các bài học trong cuốn sách này được phân chia thành các \"thủ thuật\" nhằm giúp bạn:\r\n# Ngay lập tức cải thiện được Web site của mình\r\n# Xây dựng Web site mới thật sinh động, tương thích với nhiều môi trường khác nhau\r\n# Quản lý việc thiết kế lại\r\n# Đưa Web site từ khởi đầu đến thành công', 89000, 'th14.jpg', 'gd', 'th', 5130, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 25, 12, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th15', 'Tạo Website Hấp Dẫn Với HTML, XHTML Và CSS', 'Ngày nay, việc ứng dụng phát triển Website hấp dẫn không còn gói gọn bằng HTLM, cho dù bạn đang xây dựng một Website thương mại phức tạp hoặc chỉ đơn thuần là tạo ra một Website nhỏ cho bản thân. Với cuốn sách \"Tạo Website Hấp Dẫn Với HTML, XHTML Và CSS\"  này sẽ cùng bạn khám phá các sắc thái của XHTML và CSS theo cách giúp bạn nắm được các vấn đề. Sách bao gồm nhiều thông tin mới cập nhật về XHTML, CSS, JavaScript...\r\nCuốn sách này không những giúp bạn tiết kiệm được thời gian học tập mà còn thích hợp với những ai muốn tò mò tạo một Website, vì sách cung cấp nhiều gợi ý, hướng dẫn rõ ràng trong việc chuẩn bị xuất bản những trang Web đầu tiên ngay sau khi bạn đọc qua vài chương.', 79000, 'th15.jpg', 'gd', 'th', 198, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 42, 62, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th16', 'Tuyển Tập Thủ Thuật Javascript - Tập 1', '\"Tuyển Tập Thủ Thuật Javascript\" gồm 2 tập, là một tuyển tập các giải pháp cho những vấn đề phổ biến nhất trong JavaScript. Nó chứa đựng các thủ thuật, gợi ý và kỹ thuật tương thích chuẩn, đã được thử nghiệm và bạn có thể tùy biến để sử dụng trong các trình duyệt khác nhau.', 66000, 'th16.jpg', 'gd', 'th', 5499, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 34, 65, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th17', 'Thiết Kế Web Với CSS', '\r\nTừ khi được giới thiệu năm 1996, bảng kiểu xếp tầng (CSS) đã làm thay đổi đáng kể thiết kế Web. Hiện nay, phần lớn trang Web đều sử dụng CSS và nhiều nhà thiết kế đã xây dựng các bố cục trang hoàn toàn dựa trên CSS. Để thực hiện điều này một cách thành công, đòi hỏi chúng ta phải hiểu biết kỹ về nội dung hoạt động của CSS. Sách Thiết Kế Web Với CSS cung cấp cho bạn những vấn đề cần thiết để sử dụng CSS. ', 82000, 'th17.jpg', 'gd', 'th', 6803, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 44, 31, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th18', 'Thiết Kế Web Với JavaScript Và Dom', 'Nội dung cuốn sách \"Thiết Kế Web Với JavaScript Và Dom\" giới thiệu về ngôn ngữ lập trình, nhưng nó không chỉ dành riêng cho các lập trình viên, mà còn rất có ích cho các nhà thiết kế Web.', 79000, 'th18.jpg', 'gd', 'th', 7418, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 18, 51, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg'),
('th88', 'sach giao khoa lop 10', '?', 30000, 'th18.jpg', 'gd', 'gk', 6583, '2020-11-30 18:36:47', '2020-11-30 18:37:04', 11, 52, '1.jpg;2.jpg;3.jpg;4.jpg;5.jpg;6.jpg;7.jpg');

--
-- Triggers `book`
--
DELIMITER $$
CREATE TRIGGER `cat_total` AFTER INSERT ON `book` FOR EACH ROW UPDATE category set category.total=(SELECT COUNT(*)FROM book where category.cat_id=NEW.cat_id)
WHERE category.cat_id=NEW.cat_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cat_total_delete` AFTER DELETE ON `book` FOR EACH ROW UPDATE category set category.total=(SELECT COUNT(*)FROM book where category.cat_id=OLD.cat_id)
WHERE category.cat_id=OLD.cat_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cat_total_update_new` AFTER UPDATE ON `book` FOR EACH ROW UPDATE category set category.total=(SELECT COUNT(*)FROM book where category.cat_id=NEW.cat_id)
WHERE category.cat_id=NEW.cat_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cat_total_update_old` AFTER UPDATE ON `book` FOR EACH ROW UPDATE category set category.total=(SELECT COUNT(*)FROM book where category.cat_id=OLD.cat_id)
WHERE category.cat_id=OLD.cat_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `publisher_total` AFTER INSERT ON `book` FOR EACH ROW UPDATE publisher set publisher.total=(SELECT COUNT(book.pub_id) FROM NEW WHERE book.pub_id=NEW.pub_id) WHERE publisher.pub_id=NEW.pub_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT 'admin',
  `modiffer` datetime DEFAULT NULL,
  `modiffed_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `total`, `description`, `created`, `created_by`, `modiffer`, `modiffed_by`) VALUES
('gk', 'Giáo Khoa', 40, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('khkt', 'Ky Thuat', 68, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('kt', 'Kinh Tế', 23, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('Ls', 'Lịch sử ', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('nn', 'Ngoại Ngữ', 77, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('pl', 'Pháp Luật', 59, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('td', 'Từ Điển', 64, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('test', 'Loai Moi', 42, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('th', 'Tin Học', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('tt', 'The Thao Du Lich', 74, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('vh', 'Văn Học', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL),
('vhxh', 'Van Hoa xa Hoi', 23, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-11-29 19:32:13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `fileuploads`
--

CREATE TABLE `fileuploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
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
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `img`, `short_content`, `content`, `hot`, `created`, `modiffed`) VALUES
(1, 'qqq', 'q', 'q', 'q', 0, NULL, NULL),
(2, 'ww', 'w', 'w', 'w', 1, NULL, NULL),
(3, 'ee', 'e', 'e', 'e', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(10) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `date_shiping` datetime NOT NULL,
  `user_phone` decimal(12,0) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modiffed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(10) NOT NULL,
  `book_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` double UNSIGNED NOT NULL DEFAULT 0,
  `date_create` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `pub_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pub_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pub_img` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL DEFAULT 'admin',
  `modiffed` datetime DEFAULT NULL,
  `modiffed_by` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`pub_id`, `pub_name`, `pub_img`, `total`, `description`, `created`, `created_by`, `modiffed`, `modiffed_by`) VALUES
('aadsd', 'adadad', 'Cazzpture.PNG', NULL, '<p>adadadad</p>', '2020-12-26 02:14:16', 'admin', NULL, 'admin'),
('gd', 'Giáo dục', NULL, 13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('hcm', 'Tổng Hợp Hồ Chí Minh', NULL, 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('hnv', 'Hội Nhà Văn', NULL, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('pn', 'Phụ Nữ', NULL, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('tn', 'Thanh Niên', NULL, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('vh', 'Văn Học', NULL, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin'),
('vhtt', 'Văn Hóa Thông Tin', NULL, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet', '2020-12-25 23:17:44', 'admin', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xAwNsjj9bnQUN7OT8xGpbn4qjYJizLfZwzQugHts', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNUI0ZEFSOTQxQll0MTU2N2VTWmFOMHBhQ2NMa0JIUFNJaTVDaWxHaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvdGVzdC1tYXN0ZXIvcHVibGljL2FkbWluL2FkZC11c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJ1c2VyX2luZm8iO2E6MTp7aTowO086MjU6IkFwcFxNb2RlbHNcU2hvd19pbmZvX3VzZXIiOjI3OntzOjg6IgAqAHRhYmxlIjtzOjE3OiJ1c2VyX2FjY291bnRfaW5mbyI7czoxMzoiACoAcHJpbWFyeUtleSI7czo5OiJ1c2VyX25hbWUiO3M6MTA6IgAqAGtleVR5cGUiO3M6Njoic3RyaW5nIjtzOjEwOiJ0aW1lc3RhbXBzIjtiOjA7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE1OntzOjk6InVzZXJfbmFtZSI7czoxODoibG9jZG8yNTVAZ21haWwuY29tIjtzOjk6ImZ1bGxfbmFtZSI7czo2OiJMT0MgRE8iO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMCRVOTRBb3BEWFN5UXRXeGdjdHJoQi91UG40RmdVei9Icy5remhvRTdubE95cFl3VEhYUEJiZSI7czo1OiJlbWFpbCI7czoxODoibG9jZG8yNTVAZ21haWwuY29tIjtzOjU6InBob25lIjtzOjEzOiIxLTgxOTA4MzE4MzkwIjtzOjEzOiJsaXN0X2Zhdm9yaXRlIjtOO3M6Njoic3RyZWV0IjtzOjExOiIxMDgxOTgzMDE5OCI7czo4OiJkaXN0cmljdCI7czo3OiIxMzkxOTM3IjtzOjQ6ImNpdHkiO3M6NzoiMTkzNzkxOCI7czozOiJpbWciO3M6NTI6IjEyMzk3MTE1N18xMDM3NjQ0MzkwMDM0MTkxXzg4NTI3MTc0NzQxOTg0NTE0Mzdfbi5qcGciO3M6NToibGV2ZWwiO3M6NDoidXNlciI7czo2OiJzdGF0dXMiO3M6NjoiYWN0aXZlIjtzOjc6InVzZXJfaWQiO2k6MzU7czo3OiJjcmVhdGVkIjtzOjE5OiIyMDIwLTEyLTIwIDE4OjMzOjExIjtzOjg6Im1vZGlmZmVyIjtOO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNTp7czo5OiJ1c2VyX25hbWUiO3M6MTg6ImxvY2RvMjU1QGdtYWlsLmNvbSI7czo5OiJmdWxsX25hbWUiO3M6NjoiTE9DIERPIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTAkVTk0QW9wRFhTeVF0V3hnY3RyaEIvdVBuNEZnVXovSHMua3pob0U3bmxPeXBZd1RIWFBCYmUiO3M6NToiZW1haWwiO3M6MTg6ImxvY2RvMjU1QGdtYWlsLmNvbSI7czo1OiJwaG9uZSI7czoxMzoiMS04MTkwODMxODM5MCI7czoxMzoibGlzdF9mYXZvcml0ZSI7TjtzOjY6InN0cmVldCI7czoxMToiMTA4MTk4MzAxOTgiO3M6ODoiZGlzdHJpY3QiO3M6NzoiMTM5MTkzNyI7czo0OiJjaXR5IjtzOjc6IjE5Mzc5MTgiO3M6MzoiaW1nIjtzOjUyOiIxMjM5NzExNTdfMTAzNzY0NDM5MDAzNDE5MV84ODUyNzE3NDc0MTk4NDUxNDM3X24uanBnIjtzOjU6ImxldmVsIjtzOjQ6InVzZXIiO3M6Njoic3RhdHVzIjtzOjY6ImFjdGl2ZSI7czo3OiJ1c2VyX2lkIjtpOjM1O3M6NzoiY3JlYXRlZCI7czoxOToiMjAyMC0xMi0yMCAxODozMzoxMSI7czo4OiJtb2RpZmZlciI7Tjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319fX0=', 1608924826),
('bh0qhIPP5QYZP4GMgVzmDLDhHGcVevmSC89yEMUf', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFRINVdDR1FYR05MVzl0a1RtNktpeUJ1MGl6cVZQeFhsd0txamhOMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvdGVzdC1tYXN0ZXIvcHVibGljL2FkbWluL2NhdGVnb3J5LXZpZXctYWRkP2drPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1608950802),
('6sRlW8SGOb6O8GOiU1zmoCMYlzZgYwJJVSvs8Upr', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3g3MEpLNzR5bHlXWHVRRDY1c0JERE9pamZZdFlKOG1QSDZvS01NMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODEvdGVzdC1tYXN0ZXIvcHVibGljL2FkbWluL2NhdGVnb3J5LXZpZXctYWRkP2drPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1608959674);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
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
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `name`, `description`, `link`, `thumb`, `created`, `created_by`, `modiffed`, `modiffed_by`, `status`) VALUES
(1, 'bg-image--1', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide1.jpg', '2020-11-29 16:38:53', 'admin', '2020-11-29 16:38:37', 'admin', 'active'),
(2, 'bg-image--2', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide2.jpg', '2020-11-29 16:45:41', 'admin', '2020-11-29 16:45:36', 'admin', 'active'),
(3, 'bg-image--3', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide3.jpg', '2020-11-29 16:44:54', 'admin', '2020-11-29 16:45:03', 'admin', 'active'),
(4, 'bg-image--4', '<h2>Buy <span>your </span></h2>\r\n                                <h2>favourite <span>Book </span></h2>\r\n                                <h2>from <span>Here </span></h2>', 'http://www.laptrinhweb-site.tk/', 'slide4.jpg', '2020-11-29 16:46:55', 'admin', '2020-11-29 16:46:59', 'admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'phuclp00', 'huuloc123@gmail.com', NULL, '$2y$10$a2uPjQpPMWf1IAk62vQFL.Vpeja74X7Ug98prnjRbWpDVygx2gL0C', NULL, NULL, NULL, '2020-12-07 05:52:38', '2020-12-07 05:52:38'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$BEvjsVZ3XLbIpncAy4z2mOpPpp5Y8VnYXr9M8oDu8mzLY74gc3SI.', NULL, NULL, NULL, '2020-12-07 10:35:46', '2020-12-07 10:35:46'),
(3, 'loc1', 'loc1@gmail.com', NULL, '$2y$10$bjqn5lLdUnF9123Er2InQeIvGrW9TMulbgzIbbfEvwZvJZou0UOXO', NULL, NULL, NULL, '2020-12-07 13:32:40', '2020-12-07 13:32:40'),
(4, 'loc2', 'loc2@gmail.com', NULL, '$2y$10$cXTYFmlwgkvZP.hFxoSa2OVCwEDnjqSZbrFRm18v6Qql4Vh2yL8ma', NULL, NULL, NULL, '2020-12-07 14:53:49', '2020-12-07 14:53:49'),
(5, 'loc3', 'loc3@gmail.com', NULL, '$2y$10$FR.H2bpWrIrzdWmb3ojiQu6vSts6qwc/rmSdJ7YBAJqoNGZI2ToSa', NULL, NULL, NULL, '2020-12-07 15:39:47', '2020-12-07 15:39:47'),
(6, 'Loc', 'locdo255@gmail.com', NULL, '$2y$10$KALlMz1PpmJ0ix6H8X40luvf4sHD7h6UHPkD9Li6D5K3AV4WT5UmO', NULL, NULL, NULL, '2020-12-07 18:40:34', '2020-12-07 18:40:34'),
(7, 'loc123123', '123123@gmail.com', NULL, '$2y$10$CPkiNWwAyEc5de/58iikheU0aWDUWZjxijyCM2nA8xJhSTk2fEsd.', NULL, NULL, NULL, '2020-12-07 18:45:30', '2020-12-07 18:45:30'),
(8, 'LOC', 'locdo@gmail.com', NULL, '$2y$10$pZS5MpwUHtZEFuEcknqUoecSjXr2d66ttXFDiVYwobl1uVuUUT2zK', NULL, NULL, NULL, '2020-12-07 19:37:12', '2020-12-07 19:37:12'),
(9, 'LC', 'lc1@gmail.com', NULL, '$2y$10$krgWwtHPWYKeu6eNX5A.Q.QozuZBWx.heTT9wx4RPBq.umFHDBwzW', NULL, NULL, NULL, '2020-12-07 19:40:34', '2020-12-07 19:40:34'),
(10, 'Loc123', 'loc5@gmail.com', NULL, '$2y$10$BZeBAHDoa5EYU/u2IW/WuenJFRo9x7WL6paUTjhO9ouar6c94P8Uu', NULL, NULL, NULL, '2020-12-07 22:15:56', '2020-12-07 22:15:56'),
(11, 'Loc', 'phuclp00@gmail.com', NULL, '$2y$10$HfXu2hkElgPU2Nxkowg4j.3/WDZ9uKfg/cnuRVbDKOlyaJg1Rk/Xq', NULL, NULL, NULL, '2020-12-23 10:08:04', '2020-12-23 10:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `level` varchar(10) CHARACTER SET utf32 NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modiffer` datetime DEFAULT NULL,
  `modiffer_by` varchar(45) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `user_name`, `password`, `remember_token`, `email`, `email_verified_at`, `level`, `created`, `created_by`, `modiffer`, `modiffer_by`, `status`) VALUES
(35, 'locdo255@gmail.com', '$2y$10$U94AopDXSyQtWxgctrhB/uPn4FgUz/Hs.kzhoE7nlOypYwTHXPBbe', NULL, 'locdo255@gmail.com', NULL, 'user', '2020-12-20 18:33:11', NULL, NULL, NULL, 'active'),
(37, 'loc123', '$2y$10$CKIhM8kzw4J1qlNIkx0Vaua3B8OS98xWZ2xH2nlRwKuNIb7yaorqy', NULL, 'loc123@gmail.com', NULL, 'user', '2020-12-24 00:18:57', NULL, NULL, NULL, 'active'),
(39, 'loc1234', '$2y$10$axw1hLSsCjIMJSHxYC2Mq.9AhgZQkmWIWN1NR6FL6d.WGWnjwGUAq', NULL, 'loc1234@gmail.com', NULL, 'user', '2020-12-24 07:15:43', NULL, NULL, NULL, 'active'),
(40, 'loc1', '$2y$10$SyIyz1eeWDyl/RZJURdzoOHOVLN6V5pZNGI6Cdfy6bLm0AZNzpuRu', NULL, 'loc1@1', NULL, 'user', '2020-12-24 09:43:29', NULL, NULL, NULL, 'active'),
(42, 'loc2', '$2y$10$5f2olMsN0qnZkUgT9asGSOeTdwSeDU7Y1ZPOoxKv92a47hX6MGkjq', NULL, 'loc2@1', NULL, 'user', '2020-12-24 09:43:59', NULL, NULL, NULL, 'active');

--
-- Triggers `user_account`
--
DELIMITER $$
CREATE TRIGGER `INSERT` AFTER INSERT ON `user_account` FOR EACH ROW INSERT INTO user_detail(user_detail.user_name) VALUES(NEW.user_name)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_account_info`
-- (See below for the actual view)
--
CREATE TABLE `user_account_info` (
`user_name` varchar(255)
,`full_name` varchar(255)
,`password` varchar(255)
,`email` varchar(255)
,`phone` varchar(255)
,`list_favorite` varchar(250)
,`street` varchar(255)
,`district` varchar(255)
,`city` varchar(255)
,`img` varchar(255)
,`level` varchar(10)
,`status` varchar(10)
,`user_id` int(10)
,`created` datetime
,`modiffer` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `user_name` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `list_favorite` varchar(250) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `modiffed` datetime DEFAULT NULL,
  `votes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`user_name`, `full_name`, `street`, `district`, `city`, `phone`, `list_favorite`, `img`, `modiffed`, `votes`) VALUES
('loc1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('loc123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('loc1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('loc2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('locdo255@gmail.com', 'LOC DO', '10819830198', '1391937', '1937918', '1-81908318390', NULL, '123971157_1037644390034191_8852717474198451437_n.jpg', '2020-12-21 22:07:50', '');

-- --------------------------------------------------------

--
-- Structure for view `user_account_info`
--
DROP TABLE IF EXISTS `user_account_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_account_info`  AS SELECT DISTINCT `user_account`.`user_name` AS `user_name`, `user_detail`.`full_name` AS `full_name`, `user_account`.`password` AS `password`, `user_account`.`email` AS `email`, `user_detail`.`phone` AS `phone`, `user_detail`.`list_favorite` AS `list_favorite`, `user_detail`.`street` AS `street`, `user_detail`.`district` AS `district`, `user_detail`.`city` AS `city`, `user_detail`.`img` AS `img`, `user_account`.`level` AS `level`, `user_account`.`status` AS `status`, `user_account`.`user_id` AS `user_id`, `user_account`.`created` AS `created`, `user_account`.`modiffer` AS `modiffer` FROM (`user_account` left join `user_detail` on(`user_account`.`user_name` = `user_detail`.`user_name`)) WHERE `user_account`.`level` <> 'admin' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `manxb` (`pub_id`,`cat_id`),
  ADD KEY `maloai` (`cat_id`),
  ADD KEY `book_name` (`book_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileuploads`
--
ALTER TABLE `fileuploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`) USING BTREE,
  ADD KEY `order_id` (`order_id`),
  ADD KEY `fk_order_user` (`user_name`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`book_id`) USING BTREE,
  ADD KEY `masach` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_name`) USING BTREE,
  ADD KEY `user_name` (`user_name`,`full_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fileuploads`
--
ALTER TABLE `fileuploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `publisher` (`pub_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_user_order` FOREIGN KEY (`user_name`) REFERENCES `user_detail` (`user_name`) ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_book_order` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `fk_order_orderdetail` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `a` FOREIGN KEY (`user_name`) REFERENCES `user_account` (`user_name`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
