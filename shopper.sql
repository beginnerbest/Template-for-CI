SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_template`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` smallint(4) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_var` varchar(50) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_var`) VALUES
(1, 'Shopper', 'site_name'),
(2, 'upload', 'file_upload_path'),
(3, 'shopper', 'base_dir'),
(4, 'assets', 'asset_path');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `template_id` int(12) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(150) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `template_name`, `selected`) VALUES
(1, 'default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template_settings`
--

CREATE TABLE IF NOT EXISTS `template_settings` (
  `setting_id` smallint(4) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_var` varchar(50) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_settings`
--

INSERT INTO `template_settings` (`setting_id`, `setting_name`, `setting_var`) VALUES
(5, 'default', 'theme_name'),
(6, 'index.html', 'theme_default_filename');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
