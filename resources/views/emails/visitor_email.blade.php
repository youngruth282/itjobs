<p>Name: {{ $name }}</p>
  <p>E-Mail: {{ $email }}</p>
  <p>Subject: {{ $title }}</p>
  <p>Message: <br>
  {!! nl2br($content) !!}</p>

<font color=red>* 注意：本信件是由台北靈糧堂資訊系統自動產生與發送，請勿直接回覆</font> <BR /><BR />
親愛的 <u>{{ $name }}</u> {{ $title }}平安！ <BR />
您已成功報名：<BR />
<BR />請開始預備心，歡迎您開課當天準時赴約，<BR />享受裝備中心為您所預備的屬靈豐盛宴席！<BR /><BR />
