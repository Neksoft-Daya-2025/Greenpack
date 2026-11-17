import argparse
from pathlib import Path
from cryptography.hazmat.primitives.ciphers import Cipher, algorithms, modes

parser = argparse.ArgumentParser()
parser.add_argument("key_file")
parser.add_argument("output_directory")
args = parser.parse_args()
key = bytes.fromhex(Path(args.key_file).read_text().strip())
output = Path(args.output_directory)
output.mkdir(parents=True, exist_ok=True)
for source in Path(__file__).parent.glob("*.enc"):
    target = output / source.name.removesuffix(".enc")
    temporary = target.with_name(target.name + ".partial")
    if target.exists() or temporary.exists():
        raise FileExistsError(target)
    try:
        with source.open("rb") as incoming:
            assert incoming.read(4) == b"GPK1", "Invalid archive header"
            nonce = incoming.read(12)
            incoming.seek(-16, 2)
            tag = incoming.read(16)
            decryptor = Cipher(algorithms.AES(key), modes.GCM(nonce, tag)).decryptor()
            incoming.seek(16)
            remaining = source.stat().st_size - 32
            with temporary.open("xb") as outgoing:
                while remaining:
                    chunk = incoming.read(min(4 * 1024 * 1024, remaining))
                    if not chunk:
                        raise EOFError(source)
                    remaining -= len(chunk)
                    outgoing.write(decryptor.update(chunk))
                outgoing.write(decryptor.finalize())
        temporary.rename(target)
        print(target)
    except BaseException:
        temporary.unlink(missing_ok=True)
        raise
