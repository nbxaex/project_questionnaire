<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
		<?php
		if (isset($_GET['mn'])) {
			$mn = $_GET['mn'];
			$mn2 = $_GET['mn'] . '_list';
			switch ($mn) {
					// ผู้ดูแลระบบ
				case 'users':
					$mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">บัญชีผู้ใช้</a></li>";
					break;
				case 'score':
					$mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">สะสมคะแนน</a></li>";
					break;
				case 'vote':
					$mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ประเมินความพึงพอใจ</a></li>";
					break;
				case 'assessor':
					$mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ผู้ถูกประเมิน</a></li>";
					break;
				case 'voter':
					$mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ข้อมูลประเมิน</a></li>";
					break;
			}
			echo $mn;
		} else {
			echo ' ';
		}

		if (isset($_GET['file'])) {
			$file = $_GET['file'];
			switch ($file) {
					// แอดมิน
				case 'users_add':
					$file = ' จัดการเพิ่มบัญชีผู้ใช้';
					break;
				case 'users_delete':
					$file = ' จัดการลบบัญชีผู้ใช้';
					break;
				case 'users_edit':
					$file = ' จัดการแก้ไขบัญชีผู้ใช้';
					break;
				case 'users_list':
					$file = ' จัดการบัญชีผู้ใช้';
					break;
				case 'users_view':
					$file = ' จัดการรายละเอียดบัญชีผู้ใช้';
					break;

					// สินค้า
				case 'score_add':
					$file = ' เพิ่มสะสมคะแนน';
					break;
				case 'score_delete':
					$file = ' ลบสะสมคะแนน';
					break;
				case 'score_edit':
					$file = ' แก้ไขสะสมคะแนน';
					break;
				case 'score_list':
					$file = ' ข้อมูลสะสมคะแนน';
					break;
				case 'score_view':
					$file = ' รายละเอียดการสะสมคะแนน';
					break;

				case 'vote_add':
					$file = ' เพิ่มประเมินความพึงพอใจ';
					break;
				case 'vote_delete':
					$file = ' ลบประเมินความพึงพอใจ';
					break;
				case 'vote_edit':
					$file = ' แก้ไขประเมินความพึงพอใจ';
					break;
				case 'vote_list':
					$file = ' ข้อมูลประเมินความพึงพอใจ';
					break;
				case 'vote_view':
					$file = ' รายละเอียดการประเมินความพึงพอใจ';
					break;

				case 'assessor_add':
					$file = ' เพิ่มผู้ถูกประเมิน';
					break;
				case 'assessor_delete':
					$file = ' ลบผู้ถูกประเมิน';
					break;
				case 'assessor_edit':
					$file = ' แก้ไขผู้ถูกประเมิน';
					break;
				case 'assessor_list':
					$file = ' ข้อมูลผู้ถูกประเมิน';
					break;
				case 'assessor_view':
					$file = ' รายละเอียดการผู้ถูกประเมิน';
					break;

				case 'voter_add':
					$file = ' เพิ่มข้อมูลประเมิน';
					break;
				case 'voter_delete':
					$file = ' ลบข้อมูลประเมิน';
					break;
				case 'voter_edit':
					$file = ' แก้ไขข้อมูลประเมิน';
					break;
				case 'voter_list':
					$file = ' ข้อมูลข้อมูลประเมิน';
					break;
				case 'voter_view':
					$file = ' รายละเอียดการข้อมูลประเมิน';
					break;
			} ?>
			<li class="breadcrumb-item active" aria-current="page">
				<?= $file; ?>
			</li>

		<?php
		} else {
			echo ' <li class="breadcrumb-item">
								<i class="icon-double-angle-right"></i>
								Survey
							</li>';
		}
		?>

	</ol>
</nav>