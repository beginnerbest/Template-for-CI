SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_template`
--

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_var`) VALUES
(1, 'CI Template', 'site_name'),
(2, 'upload', 'file_upload_path'),
(3, 'ci_template', 'base_dir'),
(4, 'assets', 'asset_path');

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `template_name`, `selected`) VALUES
(1, 'default', 1);

--
-- Dumping data for table `template_settings`
--

INSERT INTO `template_settings` (`setting_id`, `template_id`, `setting_name`, `setting_var`) VALUES
(5, 1, 'default', 'theme_name'),
(6, 1, 'index.html', 'theme_default_filename');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
