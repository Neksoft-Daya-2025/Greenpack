import os,sys,base64,shlex,paramiko
from pathlib import Path
ROOT="/home/u968429559/domains/neksoftconsultancy.in/public_html/greenpack"
def connect():
 c=paramiko.SSHClient(); c.load_system_host_keys(); c.set_missing_host_key_policy(paramiko.WarningPolicy()); c.connect("217.21.74.209",port=65002,username="u968429559",password=os.environ["GREENPACK_SSH_PASSWORD"],timeout=20); return c
def run_php(c,php):
 command="cd "+ROOT+" && wp eval "+shlex.quote('eval(base64_decode("'+base64.b64encode(php.encode()).decode()+'"));')
 _,o,e=c.exec_command(command,timeout=50);out=o.read().decode();err=e.read().decode();status=o.channel.recv_exit_status()
 if status:raise RuntimeError(err+out)
 if err:print(err,file=sys.stderr)
 return out
if __name__=="__main__":
 c=connect()
 try: print(run_php(c,Path(sys.argv[1]).read_text(encoding="utf-8")))
 finally:c.close()
