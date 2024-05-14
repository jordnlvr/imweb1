<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	<title>Transaction Successful</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700&display=swap');

		.ReadMsgBody {
			width: 100%;
			background-color: #ffffff;
		}

		.ExternalClass {
			width: 100%;
			background-color: #ffffff;
		}

		.ExternalClass,
		.ExternalClass p,
		.ExternalClass span,
		.ExternalClass font,
		.ExternalClass td,
		.ExternalClass div {
			line-height: 100%;
		}

		html {
			width: 100%;
		}

		body {
			-webkit-text-size-adjust: none;
			-ms-text-size-adjust: none;
			margin: 0;
			padding: 0;
		}

		table {
			border-spacing: 0;
			/*border-collapse: collapse;*/
		}

		table td {
			border-collapse: collapse;
		}

		.yshortcuts a {
			border-bottom: none !important;
		}

		img {
			display: block !important;
		}

		a {
			text-decoration: none;
			color: inherit;
		}

		/* Media Queries */

		@media only screen and (max-width: 640px) {
			body {
				width: auto !important;
			}

			table[class="table600"] {
				width: 450px !important;
			}

			table[class="table-container"] {
				width: 90% !important;
			}

			table[class="container2-2"] {
				width: 47% !important;
				text-align: left !important;
			}

			table[class="full-width"] {
				width: 100% !important;
				text-align: center !important;
			}

			img[class="img-full"] {
				width: 100% !important;
				height: auto !important;
			}
		}

		@media only screen and (max-width: 479px) {
			body {
				width: auto !important;
			}

			table[class="table600"] {
				width: 100% !important;
			}

			table[class="table-container"] {
				width: 82% !important;
			}

			table[class="container2-2"] {
				width: 100% !important;
				text-align: left !important;
			}

			table[class="full-width"] {
				width: 100% !important;
				text-align: center !important;
			}

			img[class="img-full"] {
				width: 100% !important;
				height: auto !important;
			}
		}
	</style>

</head>

<body marginwidth="0" marginheight="0" style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;" offset="0" topmargin="0" leftmargin="0" background="#fff">

	<!-- ARTICLE LEFT -->
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td align="center" style="padding: 0 30px; background: #000;">
					<table class="table600" width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
						<tbody>
							<tr>
								<td>
									<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center">
												<table class="table600" width="600" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td height="30" style="font-size: 1px; line-height: 30px;">
															&nbsp;</td>
													</tr>
													<tr>
														<td>
															<table class="full-width" align="center" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td align="center" valign="top">
																		<img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" style="width:260px;" width="260">
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="30" style="font-size: 1px; line-height: 30px;">
															&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="500" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tbody>
											<tr>
												<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 400; color: #ffffff;">
													Dear <?= ($name ? $name : 'Client'); ?>,
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center">
									<table class="table-container" width="500" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tbody>
											<tr>
												<td height="30" style="font-size: 1px; line-height: 30px;">&nbsp;
												</td>
											</tr>
											<tr>
												<td>
													<table class="full-width" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
														<tr>
															<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight:500; color: #ffffff;">
																We are pleased to inform you that your recent transaction has been processed successfully.
															</td>
														</tr>
														<tr>
															<td height="20" style="font-size: 1px; line-height: 20px;">
																&nbsp;</td>
														</tr>
														<tr>
															<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight:500; color: #ffffff;">
																Reference Number: <strong><?= $GatewayRefNum; ?></strong>
															</td>
														</tr>
														<tr>
															<td height="20" style="font-size: 1px; line-height: 20px;">
																&nbsp;</td>
														</tr>
														<tr>
															<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight:500; color: #ffffff;">
																Amount: <strong>$<?= $amount; ?></strong>
															</td>
														</tr>
														<tr>
															<td height="20" style="font-size: 1px; line-height: 20px;">
																&nbsp;</td>
														</tr>
														<tr>
															<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 14px; font-weight: 400; color: #ffffff; line-height: 24px;">
																This email is to notify you that your transportation reservation booking payment was approved.
															</td>
														</tr>
														<tr>
															<td height="20" style="font-size: 1px; line-height: 15px;">
																&nbsp;</td>
														</tr>
														<tr>
															<td align="left" style="font-family: 'Roboto', sans-serif; font-size: 14px; font-weight: 400; color: #ffffff; line-height: 24px;">
																Thank You!
																<br />
																<strong>The PayMe.Limo Support Team</strong>
																<br /><br />
															</td>
														</tr>
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
	<!-- END ARTICLE LEFT -->
</body>

</html>