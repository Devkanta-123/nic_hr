<?php

namespace app\misc;
use app\database\DBController;
use app\modules\settings\classes\Session;

class Email
{
	public static function send($data, $EmailID, $Subject)
	{
		$sender = 'no-reply@techz.in';
		$organisation = 'ITPL';

		$param = array(
			array(":Description", $data),
			array(":EmailID", $EmailID),
            array(":Subject", $Subject),
            array(":SessionID",1)
		);

		$query = "INSERT INTO EmailDetails(Description, EmailID, Subject, SessionID) VALUES (:Description,:EmailID,:Subject,:SessionID);";

		$result = DBController::ExecuteSQL($query, $param);
		if ($result) {

			$html = '<html lang="en">
						<head>
						</head>
						<body>
							<div style="height:100%;width:100%;background-color:#ebebeb;margin:0;padding:0" bgcolor="#ebebeb">
								<center>
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" id="m_-2713487906417072868bodyTable" style="height:100%;border-collapse:collapse;width:100%;background-color:#ebebeb;margin:0;padding:0" bgcolor="#ebebeb">
										<tbody>
											<tr>
												<td align="center" valign="top" id="m_-2713487906417072868bodyCell" style="height:100%;width:100%;border-top-width:0;margin:0;padding:10px">
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;max-width:600px!important;border:0">
														<tbody>
															<tr>
																<td style="line-height:32px">&nbsp;</td>
															</tr>
															<tr>
																<td valign="top" id="m_-2713487906417072868templatePreheader" style="border-top-color:darkcyan;border-top-style:solid;border-top-width:6px;border-bottom-width:0;padding-top:9px;padding-bottom:9px;background:#ffffff none no-repeat center/cover" bgcolor="#ffffff">
																	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
																		<tbody>
																			<tr>
																				<td valign="top" style="padding-top:9px">
																					<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%;border-collapse:collapse" width="100%">
																						<tbody>
																							<tr>
																								<td valign="top" style="text-align:center;word-break:break-word;color:#656565;font-family:Helvetica;font-size:12px;line-height:150%;padding:0px 18px 9px" align="center">
																									<img align="left" alt="'.$organisation.'" height="100" width="100px" src="https://techz.in/assets/img/logo.png" style="height:auto!important;padding-left:14px;outline:none;text-decoration:none;margin:0px;border:0px;" title="'.$organisation.'" class="CToWUd">
																								</td>
																								<td>
																									<h2 style="font-size: 5em; margin:0">'.$organisation.'</h2>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td valign="top" id="m_-2713487906417072868templateBody" style="border-top-width:0;border-bottom-color:#eaeaea;border-bottom-width:2px;border-bottom-style:none;padding-top:0;padding-bottom:9px;background:#ffffff none no-repeat center/cover" bgcolor="#ffffff">
																	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
																		<tbody>
																			<tr>
																				<td valign="top" style="padding-top:9px">
																					<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%;border-collapse:collapse" width="100%">
																						<tbody>
																							<tr>
																								<td valign="top" style="font-family:\'Open Sans\',Helvetica,Arial,sans-serif;font-size:16px;padding:0 32px 9px">
																									'.$data.'
																									<p style="color:#333333;margin:10px 0;padding:0">
																										Thank you,<br>'.$organisation.'
																									</p>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td valign="top" id="m_-2713487906417072868templateFooter" style="border-top-width:0;border-bottom-width:0;padding-top:16px;padding-bottom:16px;background:#f7f7f7 none no-repeat center/cover" bgcolor="#f7f7f7">
																	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
																		<tbody>
																			<tr>
																				<td valign="top" style="padding-top:9px">
																					<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%;border-collapse:collapse" width="100%">
																						<tbody>
																							<tr>
																								<td valign="top" style="padding-top:0;padding-bottom:9px;font-size:12px;font-family:\'Open Sans\',Helvetica,Arial,sans-serif;word-break:break-word;color:#656565;line-height:150%;text-align:center" align="center">
																									
																									<em>Copyright © 2020</em>
																									<br>NIC HRPrivate Limited
																									<br>Shillong 793001,Meghalaya, India
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</center>
								<div class="yj6qo"></div>
								<div class="adL"></div>
							</div>
						</body>
					</html>';

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <'.$sender.'>' . "\r\n"; 
            return @mail($EmailID, $Subject, $html, $headers);
		}else {
			return false;
		}
	}
	
}