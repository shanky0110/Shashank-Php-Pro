<?
include_once("myconnect.php");

if ( $_REQUEST["radiobutton"]=='A' || $_REQUEST["radiobutton"]=='B')
{
			$sql="Select * from sbjbs_seekers where 1";
			$rs0=mysql_query($sql);
			$cnt=0;
			while ( ($rs=mysql_fetch_array($rs0)) )
			{							
			 $from =$_REQUEST["email"];
			 $to = $rs["sb_email_addr"];
			 $subject = $_REQUEST["subject"];
			 $body = $_REQUEST["message"];
		     $header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
			if(isset($_REQUEST["html"])&&($_REQUEST["html"]=="yes"))
			{
			$header .= "\r\nMIME-Version: 1.0";
			$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
			}
//			echo $to."--------".$header;
//	echo "<br><pre>$body</pre>";
			mail($to,$subject,$body,$header);
			}

}//die();
if ( $_REQUEST["radiobutton"]=='M' || $_REQUEST["radiobutton"]=='B')
{
			$sql="Select * from sbjbs_newsletter";
			$rs0=mysql_query($sql);
			$cnt=0;
			while ( ($rs=mysql_fetch_array($rs0)) )
			{							
			 $from =$_REQUEST["email"];
			 $to = $rs["sb_email"];
			 $subject = $_REQUEST["subject"];
			 $body = $_REQUEST["message"];
		     $header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
			
			if(isset($_REQUEST["html"])&&($_REQUEST["html"]=="yes"))
			{
			$header .= "\r\nMIME-Version: 1.0";
			$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
			}
			//echo $header;
			 mail($to,$subject,$body,$header);
			}

}

if ( $_REQUEST["radiobutton"]=='E' || $_REQUEST["radiobutton"]=='B')
{
			$sql="Select * from sbjbs_employers where 1";
			$rs0=mysql_query($sql);
			$cnt=0;
			while ( ($rs=mysql_fetch_array($rs0)) )
			{							
			 $from =$_REQUEST["email"];
			 $to = $rs["sb_email_addr"];
			 $subject = $_REQUEST["subject"];
			 $body = $_REQUEST["message"];
		     $header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
			if(isset($_REQUEST["html"])&&($_REQUEST["html"]=="yes"))
			{
			$header .= "\r\nMIME-Version: 1.0";
			$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
			}
	//		echo $to."to: $to ---from: $from----subject: $subject------header-".$header;
//	echo "<br><pre>$body</pre>";
			mail($to,$subject,$body,$header);
			}

}

header("Location: ". "adminhome.php?msg=" . urlencode("Your Message has been sent!") );
die();
?>