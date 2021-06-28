<div style="width:100%;border: 1px solid #cdcdcd;padding: 2px;">
	<div style="width:100%;text-align:center;margin-bottom: 10px;">
		<div style="width: 15%;float:left;">
			<img style="margin: 5px;min-height: 100px;" src="{SITE_LOGO_SRC}"  width="150px;">
		</div>
		<div style="width: 85%;float:left;text-align:center;font-family: Arial, Helvetica, sans-serif;">
			<h2>{PANEL_HEAD}</h2>
			<h5 style="margin:5px;">({DATE}})</h5>
		</div>
		<div style="clear: both;"></div>
	</div>

	<div style="width:100%;">{PANEL_BODY_TEXT}</div>
	<br>
	<div style="width:100%;">{MAX_TW_COUNT_LABEL} :  <b>{MAX_TW_COUNT}</b> </div>
	<div style="width:100%;">{CURRENT_TW_COUNT_LABEL} :  <b>{CURRENT_TW_COUNT}</b> </div>
	<br>

	<div class="panel" style="width:100%;text-align:center;font-family: Arial, Helvetica, sans-serif;" >
		<div class="panel-body">
			<table id="company_report" style="width:100%;border-collapse: collapse;" class="table table-striped table-bordered text-right">
				<tbody style="text-align:center;">
					<tr style="background:#f2f2f2;">
						<td style="border: 1px solid #ddd;padding:7px;font-weight: bold;">{CMP_NAME_LABEL}</td>
						<td style="border: 1px solid #ddd;padding:7px;">{CMP_NAME}</td>
					</tr>

					<tr style="background:#ffffff;">
						<td style="border: 1px solid #ddd;padding:7px;font-weight: bold;">{EMP_NAME_LABEL}</td>
						<td style="border: 1px solid #ddd;padding:7px;">{EMP_NAME}</td>
					</tr>

					<tr style="background:#f2f2f2;">
						<td style="border: 1px solid #ddd;padding:7px;font-weight: bold;">{EMP_EMAIL_LABEL}</td>
						<td style="border: 1px solid #ddd;padding:7px;">{EMP_EMAIL}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>